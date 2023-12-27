<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
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
            $parts= explode('-',$date);
            $income = Income::query()
            ->where('user_id', $userId)
            ->whereMonth('date', $parts[1])
            ->whereYear('date', $parts[0])
            ->firstOrFail();
            
            // dd($income);
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
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "You need to insert an income first"
                ],
                Response::HTTP_NOT_FOUND
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

    public function getOneExpenseById(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;
            $expense = Expense::query()
                ->where('user_id', $userId)
                ->findOrFail($id);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Expense gotted successfully",
                    "data" => $expense
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Expense not found for this user"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllExpensesByDate(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $month=request('month');
            $year=request('year');
            $expenses = Expense::query()
                               ->with('category')
                               ->where('user_id',$userId)
                               ->whereMonth('date',$month)
                               ->whereYear('date',$year)
                               ->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Successfully retrieved all expenses for the month of {$month}",
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

    public function deleteExpenseById(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;
            Expense::query()
                ->where('user_id', $userId)
                ->findOrFail($id);
            $deletedExpense = Expense::destroy($id);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Expense deleted successfully",
                    "data" => $deletedExpense
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Expense not found for this user"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function editExpenseDescription(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;

            $expenseToEdit = Expense::query()
                ->where("id", $id)
                ->where('user_id', $userId)
                ->firstOrFail();

            $newDescription = $request->input('description');

            $expenseToEdit->description = $newDescription;
            $expenseToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Expense edited successfully'
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Not Found this user's expense"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error editing expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function editCategoryExpense(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;

            $expenseToEdit = Expense::query()
                ->where('user_id', $userId)
                ->findOrFail($id);

            $newCategory = $request->input('category');

            $expenseToEdit->category_id = $newCategory;
            $expenseToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Expense edited successfully',
                    'data' => $expenseToEdit
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Not Found this user's expense"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error editing expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function editAmountExpense(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;

            $expenseToEdit = Expense::query()
                ->where('user_id', $userId)
                ->findOrFail($id);

            $newAmount = $request->input('amount');

            $expenseToEdit->amount = $newAmount;
            $expenseToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Expense edited successfully',
                    'data' => $expenseToEdit
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "Not Found this user's expense"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error editing expense"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
