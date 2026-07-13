<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|string|min:8',

        ]);

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt($request->password),

            'city_id' => $request->city_id,

            'school_id' => $request->school_id,

            'phone' => $request->phone,

            'whatsapp' => $request->whatsapp,

            'instagram' => $request->instagram,

        ]);

        $user->sendEmailVerificationNotification();

        $token = $user
            ->createToken('livronet')
            ->plainTextToken;

        return response()->json([

            'user' => $user,

            'token' => $token,

            'email_verification_required' => true,

            'message' => 'E-mail de confirmação enviado.',

        ]);
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {

            return response()->json([
                'message' => 'E-mail já confirmado.',
            ]);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'E-mail reenviado com sucesso.',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);

        $user = User::where('email', $request->email)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],

            ]);
        }

        $token = $user
            ->createToken('livronet')
            ->plainTextToken;

        return response()->json([

            'user' => $user,

            'token' => $token,

        ]);
    }

    public function me(Request $request)
    {
        $user = User::with([
            'city',
            'school',
        ])->findOrFail(
            $request->user()->id
        );

        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'city_id' => 'nullable|exists:cities,id',

            'school_id' => 'nullable|exists:schools,id',

            'phone' => 'nullable|string|max:30',

            'whatsapp' => 'nullable|string|max:30',

            'instagram' => 'nullable|string|max:100',
        ]);

        $user = $request->user();

        $user->update([
            'name' => $request->name,

            'city_id' => $request->city_id,

            'school_id' => $request->school_id,

            'phone' => $request->phone,

            'whatsapp' => $request->whatsapp,

            'instagram' => $request->instagram,
        ]);

        return response()->json(
            User::with([
                'city',
                'school',
            ])->findOrFail($user->id)
        );
    }

    public function logout(Request $request)
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([

            'message' => 'Logout realizado.',

        ]);
    }

    public function emailStatus(Request $request)
    {
        return response()->json([
            'email_verified' => ! is_null(
                $request->user()
                    ->email_verified_at
            ),
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink([
            'email' => $request->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {

            return response()->json([
                'message' => 'Link de recuperação enviado.',
            ]);
        }

        return response()->json([
            'message' => 'Não foi possível enviar o link.',
        ], 422);
    }

    public function changeEmail(Request $request)
    {
        $request->validate([

            'email' => 'required|email|unique:users,email',

            'password' => 'required',

        ]);

        $user = $request->user();

        if (! Hash::check(
            $request->password,
            $user->password
        )) {

            return response()->json([
                'message' => 'Senha atual inválida.',
            ], 422);
        }

        $user->update([

            'email' => $request->email,

            'email_verified_at' => null,

        ]);

        $user->sendEmailVerificationNotification();

        return response()->json([

            'message' => 'E-mail alterado com sucesso. Uma nova confirmação foi enviada.',

        ]);
    }
}
