<?php

use App\Models\User;
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
