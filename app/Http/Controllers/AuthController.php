<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Cari user by email
    $user = User::where('email', $credentials['email'])->first();

    // Cek password
    if (!$user || !\Hash::check($credentials['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Kredensial tidak cocok.'],
        ]);
    }

    // Buat token
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token
    ], 200);
}

    /**
     * Log the user out of the application.
     */
public function logout(Request $request)
{
    // Hapus token yang sedang dipakai
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logout berhasil'], 200);
}

    
    /**
     * Get the authenticated user details.
     */
    public function user(Request $request)
    {
        // Hanya bisa diakses jika user sudah login (middleware auth:sanctum)
        return response()->json($request->user());
    }
}