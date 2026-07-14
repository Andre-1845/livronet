<?php

use App\Models\User;
use App\Services\AccountDeletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/email/verify/{id}/{hash}', function (
    Request $request,
    $id,
    $hash
) {

    $user = User::findOrFail($id);

    if (! hash_equals(
        sha1($user->getEmailForVerification()),
        $hash
    )) {

        abort(403);
    }

    if (! $user->hasVerifiedEmail()) {

        $user->markEmailAsVerified();
    }

    return view('email/email-verified');

})->middleware('signed')
    ->name('verification.verify');

Route::get('/reset-password/{token}', function (
    string $token,
    Request $request
) {

    return view(
        'auth.reset-password',
        [
            'token' => $token,
            'email' => $request->email,
        ]
    );

})->name('password.reset');

Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => ['required'],
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed', 'min:6'],
    ]);

    $status = Password::reset(

        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),

        function ($user, $password) {

            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        }

    );

    if ($status == Password::PASSWORD_RESET) {

        return view('auth.password-reset-success');
    }

    return back()->withErrors([
        'email' => [__($status)],
    ]);
});

// ---------------- EXCLUSÃO DE CONTA (exigência da Play Store) ----------------
// Precisa funcionar mesmo sem o usuário estar logado no app / com o app
// instalado, por isso é um fluxo via web, no mesmo espírito do
// "esqueci minha senha" acima.

Route::get('/account/delete', function () {

    return view('account.delete-request');

})->name('account.delete.request');

Route::post('/account/delete', function (Request $request) {

    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $request->email)->first();

    // Por privacidade, a resposta é sempre a mesma independente do
    // e-mail existir ou não na base — evita que alguém use esse
    // formulário pra descobrir se um e-mail está cadastrado.
    if ($user) {

        $user->notify(new \App\Notifications\AccountDeletionRequested());
    }

    return view('account.delete-request-sent');
});

Route::get('/account/delete/confirm/{id}/{hash}', function (
    string $id,
    string $hash,
    AccountDeletionService $accountDeletionService
) {

    $user = User::withTrashed()->findOrFail($id);

    // Idempotente: se já foi excluída (ex: clicou no link duas vezes),
    // só mostra a página de sucesso de novo, sem tentar apagar de novo
    // (o que quebraria, já que o e-mail já foi anonimizado).
    if ($user->trashed()) {

        return view('account.delete-confirmed');
    }

    if (! hash_equals(sha1($user->email), $hash)) {

        abort(403);
    }

    $accountDeletionService->deleteAccount($user);

    return view('account.delete-confirmed');

})->middleware('signed')
    ->name('account.delete.confirm');
