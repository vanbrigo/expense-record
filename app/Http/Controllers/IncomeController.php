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
}
