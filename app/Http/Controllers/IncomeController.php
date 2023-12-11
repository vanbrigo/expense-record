<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IncomeController extends Controller
{
    public function createIncome(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $amount = $request->input('amount');
            $categoryId = $request->input('category_id');
            $description = $request->input('description');
            $date = $request->input('date');

            Category::query()
                ->where('type', 'income')
                ->findOrFail($categoryId);
            $newIncome = Income::create([
                'user_id' => $userId,
                'amount' => $amount,
                'category_id' => $categoryId,
                'description' => $description,
                'date' => $date
            ]);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Created income successfully",
                    "data" => $newIncome
                ],
                Response::HTTP_CREATED
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Category not found"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating income"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllIncomesByUserId(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $incomes = Income::query()->where('user_id',$userId)->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Successfully retrieved all incomes",
                    "data" => $incomes
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all incomes"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllIncomesByDate(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $month=request('month');
            $year=request('year');
            $incomes = Income::query()
                               ->where('user_id',$userId)
                               ->whereMonth('date',$month)
                               ->whereYear('date',$year)
                               ->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Successfully retrieved all incomes for the month of {$month}",
                    "data" => $incomes
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all incomes"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deleteIncomeById(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;
            Income::query()
                ->where('user_id', $userId)
                ->findOrFail($id);
            Income::destroy($id);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Income deleted successfully"
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Income not found for this user"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting income"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function editIncomeDescription(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;

            $incomeToEdit = Income::query()
                ->where('user_id', $userId)
                ->findOrFail($id);

            $newDescription = $request->input('description');

            $incomeToEdit->description = $newDescription;
            $incomeToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Income edited successfully'
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Not Found this user's income"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error editing income"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
