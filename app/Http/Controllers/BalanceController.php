<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BalanceController extends Controller
{
    public function getAllBalancesByUserId(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $balances = Balance::query()->where('user_id',$userId)->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "All balances retrieved successfully",
                    "data" => $balances
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all balances"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getOneBalanceByDate(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $month=request('month');
            $year=request('year');
            $balance = Balance::query()
                               ->where('user_id',$userId)
                               ->whereMonth('date',$month)
                               ->whereYear('date',$year)
                               ->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Successfully retrieved balance for the month of {$month}",
                    "data" => $balance
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting balance"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
