<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller
{
    public function createExpense(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $amount = $request->input('amount');
            $categoryId = $request->input('category_id');
            $description = $request->input('description');
            $date = $request->input('date');
            $payMethodId = $request->input('pay_method_id');

            $newExpense = Expense::create([
                'user_id' => $userId,
                'amount' => $amount,
                'category_id' => $categoryId,
                'description' => $description,
                'date' => $date,
                'pay_method_id' => $payMethodId
            ]);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Created expense successfully",
                    "data" => $newExpense
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllExpensesByUserId(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $expenses = Expense::query()->where('user_id',$userId)->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Get all expenses successfully",
                    "data" => $expenses
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
