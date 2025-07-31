<?php

namespace App\Services\v1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register($data) 
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function login($data)
    {
        return $this->attemptLogin($data, false);
    }

    public function adminlogin($data)
    {
        return $this->attemptLogin($data, true);
    }

    private function attemptLogin(array $data, bool $requireAdmin)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($requireAdmin && !$user->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
            ], 403);
        }

        // Revoke existing tokens
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        $user = auth()->user();

        // Revoke the current access token
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
}