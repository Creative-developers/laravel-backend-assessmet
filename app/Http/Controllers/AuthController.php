<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required','string','max:255',
            'last_name' => 'required','string','max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'user' => $user,
        ], 201);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'error' => 'Invalid credentials',
            ]);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ], 201);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
           'message' => 'User logged out successfully',
        ], 200);
    }
}
