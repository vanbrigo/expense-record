<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'nickname' => 'required|min:3|max:50',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8|max:12',
                'avatar_url' => 'url:http,https'
            ]);

            // if () {
            //     return response()->json(
            //         [
            //             "success" => false,
            //             "message" => "Error registering user",
            //             // "error" => $validator->errors()
            //         ],
            //         Response::HTTP_BAD_REQUEST
            //     );
            // }

            $password = $request->input('password');
            $encryptedPassword = bcrypt($password);

            $newUser = User::create(
                [
                    "nickname" => $request->input('nickname'),
                    "email" => $request->input('email'),
                    "password" => $encryptedPassword
                ]
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
}
