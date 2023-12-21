<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminController extends Controller
{
    public function getAllUsers(Request $request)
    {
        try {
            $users = User::query()->where('is_active',true)->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Users retrieved successfully",
                    "data" => $users
                ],
                Response::HTTP_OK
            );  
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all users"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
