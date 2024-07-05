<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            // Generate access token for the user
            $accessToken = $user->createToken('appToken')->accessToken;

            // Return the user data and access token
            return [
                'user' => $user,
                'token' => $accessToken,
            ];
        }
        return null;
    }


    public function register($userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        $userData['email_verified_at'] = now();
        $user = User::create($userData);

        // Generate access token for the user
        $accessToken = $user->createToken('authToken')->accessToken;

        // Return the user data and access token
        return [
            'user' => $user,
            'token' => $accessToken,
        ];
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::user()->token()->revoke();
            return true;
        }

        return false;
    }
}
