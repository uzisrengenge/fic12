<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    Public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'email|required',
            'password' => 'required',
            'phone' => 'required',
            'roles' => 'required',
        ]);

        //password encryption
        $validatedData['password'] = Hash::make($validatedData['password']);


        $user = User::create($validatedData);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ],201);
    }

    Public function logout (Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out',
        ],200);
    }

    Public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::where('email',$loginData['email'])->first();

        if(!$user)
        {
            return response()->json([
                'message' => 'Invalid Credentials',
            ],401);
        }

        if (!Hash::check($loginData['password'], $user->password))
        {
            return response()->json([
                'message' => 'Invalid Credentials',
            ],401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ],200);

    }



}
