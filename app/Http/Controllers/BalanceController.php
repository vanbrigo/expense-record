<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Expense;
use App\Models\Income;
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


             //recuperar ingresos
             //recuperar gastos
             //calcular balance
             //devolver balance
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

    public function createBalance(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $date= $request->input('date');
            $income = $request->input('income');
            $expense = $request->input('expense');
            $balance = $request->input('balance');
            

            $newBalance = Balance::create([
                'user_id' => $userId,
                'date' => $date,
                'income' => $income,
                'expenses'=> $expense,
                'balance'=> $balance
            ]);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Created balance successfully",
                    "data" => $newBalance
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating balance"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getBalanceByDate(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $month=request('month');
            $year=request('year');
            $totalExpenses = Expense::query()
                               ->where('user_id',$userId)
                               ->whereMonth('date',$month)
                               ->whereYear('date',$year)
                               ->sum('amount');
            
            $totalIncomes = Income::query()
                               ->where('user_id',$userId)
                               ->whereMonth('date',$month)
                               ->whereYear('date',$year)
                               ->sum('amount');
            $totalBalance=$totalIncomes-$totalExpenses;
            $balance=[
                "expenses" => $totalExpenses,
                "incomes" => $totalIncomes,
                "balance" => $totalBalance
            ];
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
                    "message" => "Error getting all expenses"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}


