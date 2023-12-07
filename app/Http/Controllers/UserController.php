<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        try {
            $user = auth()->user();

        return response()->json(
            [
                "success" => true,
                "message" => "User profile",
                "data" => $user
            ],
            Response::HTTP_OK
        );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting user profile"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        
        $token->delete();
        
        return response()->json(
            [
                "success" => true,
                "message" => "Logout successfully"
            ],
            Response::HTTP_OK
        );
    }
}
