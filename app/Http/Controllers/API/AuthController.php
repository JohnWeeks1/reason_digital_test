<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register method
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        // Create new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        // Generate new token for user
        $token = $user->createToken('user_token')->plainTextToken;

        // Return relevant information
        return response()->json(['user' => $user, 'token' => $token], 200);

    }

    /**
     * Login method
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            // Get the user by email if exists
            $user = User::where('email', '=', $request->input('email'))->firstOrFail();

            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['error' => 'Something went wrong login in? Please try again.'], 400);
            }

            // Generate new token for user
            $token = $user->createToken('user_token')->plainTextToken;

            // Return relevant information
            return response()->json(['user' => $user, 'token' => $token], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong? Please try again.'], 400);
        }

    }
}
