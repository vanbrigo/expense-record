<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            
            $userValidated = $request->validate([
                'nickname' => 'required|min:3|max:50',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6|max:12',
                'avatar_url' => 'url:http,https|image|nullable|max:500'
            ]);

            $newUser= User::create(
                $userValidated
            );

            // enviar email de bienvenida
            return response()->json(
                [
                    "success" => true,
                    "message" => "user registered",
                    "data" => $newUser
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $userValidated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $email=$userValidated['email'];
            $user = User::query()->where('email', $email)->first();
    
            if (!$user) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password are invalid 1"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            if (!Hash::check($userValidated['password'], $user->password)) {
                throw new Error('Email or password are invalid 2');

                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password are invalid 2"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $token = $user->createToken('apiToken')->plainTextToken;

            return response()->json(
                [
                    "success" => true,
                    "message" => "User Logged succesfully",
                    "token" => $token,
                    "data" => $user
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if($th->getMessage() === 'Email or password are invalid 2') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password are invalid 2"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error login user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}


