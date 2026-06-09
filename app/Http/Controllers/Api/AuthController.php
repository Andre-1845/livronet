<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6',

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

        $token = $user
            ->createToken('livronet')
            ->plainTextToken;

        return response()->json([

            'user' => $user,

            'token' => $token,

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
}
