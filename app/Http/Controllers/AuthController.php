<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request)
    {
        // Validate fields
        $attributes = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required',
        ]);

        // Create a user
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::create($attributes);

        // Return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
        ], 200);
    }

    // Login user
    public function login(Request $request)
    {
        // Validate fields
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to login
        if (!Auth::attempt($attributes)) {
            return response([
                'message' => "Invalid credentials",
            ], 403);
        }

        // Return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken,
        ], 200);
    }

    // Logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => "Logout Success",
        ], 200);
    }
    
    

    // Show user info
    public function user()
    {
        return response([
            'user' => auth()->user(),
        ], 200);
    }
}
