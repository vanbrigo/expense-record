<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function getAllExpensesCategories(Request $request)
    {
        try {
            $categories = Category::query()->where('type','expense')->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Expenses categories retrieved successfully",
                    "data" => $categories
                ],
                Response::HTTP_OK
            );  
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all expenses categories"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
