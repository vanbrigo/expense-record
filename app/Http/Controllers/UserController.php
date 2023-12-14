<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function editUserNickname(Request $request)
    {
        try {
            $userId = auth()->user()->id;

            $userToEdit = User::query()
                ->findOrFail($userId);

            $newNickname = $request->input('nickname');

            $userToEdit->nickname = $newNickname;
            $userToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Nickname updated successfully',
                    'data'=> $userToEdit
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "User not found"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating nickname"
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
