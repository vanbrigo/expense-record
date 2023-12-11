<?php

namespace App\Http\Controllers;

use App\Models\Pay_Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Pay_methodController extends Controller
{
    public function getAllPayMethods(Request $request)
    {
        try {
            $payMethods = Pay_Method::query()->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Pay methods retrieved successfully",
                    "data" => $payMethods
                ],
                Response::HTTP_OK
            );  
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all pay methods"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
