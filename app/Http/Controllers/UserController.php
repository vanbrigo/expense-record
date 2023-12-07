<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
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
