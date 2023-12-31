<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\Pay_methodController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::group([
    'middleware' =>[
        'auth:sanctum']
    ], function (){
        Route::get('/profile',[UserController::class,'profile']);
        Route::post('/logout',[UserController::class,'logout']);
        Route::put('/edit-nickname',[UserController::class,'editUserNickname']);
        Route::put('/edit-avatar',[UserController::class,'editUserAvatar']);
        
        Route::get('/pay-methods',[Pay_methodController::class,'getAllPayMethods']);
        
        Route::get('/categories-expenses',[CategoryController::class,'getAllExpensesCategories']);
        Route::get('/categories-incomes',[CategoryController::class,'getAllIncomesCategories']);

        Route::get('/all-expenses',[ExpenseController::class,'getAllExpensesByUserId']);
        Route::get('/expenses',[ExpenseController::class,'getAllExpensesByDate']);
        Route::get('/expense/{id}',[ExpenseController::class,'getOneExpenseById']);
        Route::post('/new-expense',[ExpenseController::class,'createExpense']);
        Route::put('/edit-expense/{id}',[ExpenseController::class,'editExpenseDescription']);
        Route::delete('/delete-expense/{id}',[ExpenseController::class,'deleteExpenseById']);
        Route::put('/edit-expense-category/{id}',[ExpenseController::class,'editCategoryExpense']);
        Route::put('/edit-expense-amount/{id}',[ExpenseController::class,'editAmountExpense']);

        Route::get('/all-incomes',[IncomeController::class,'getAllIncomesByUserId']);
        Route::get('/incomes',[IncomeController::class,'getAllIncomesByDate']);
        Route::get('/income/{id}',[IncomeController::class,'getOneIncomeById']);
        Route::post('/new-income',[IncomeController::class,'createIncome']);
        Route::delete('/delete-income/{id}',[IncomeController::class,'deleteIncomeById']);
        Route::put('/edit-income/{id}',[IncomeController::class,'editIncomeDescription']);
        Route::put('/edit-income-category/{id}',[IncomeController::class,'editCategoryIncome']);
        Route::put('/edit-income-amount/{id}',[IncomeController::class,'editAmountIncome']);


        Route::get('/all-balances',[BalanceController::class,'getAllBalancesByUserId']);
        Route::get('/balance',[BalanceController::class,'getOneBalanceByDate']);
        Route::get('/balance-date',[BalanceController::class,'getBalanceByDate']);
        Route::post('/new-balance',[BalanceController::class,'createBalance']);
    }
);

Route::group([
    'middleware' => ['auth:sanctum', 'is_super_admin']
], function () {
    Route::get('/all-users',[SuperAdminController::class,'getAllUsers']);
    Route::get('/all-categories',[SuperAdminController::class,'getAllCategories']);
    Route::post('/new-category',[SuperAdminController::class,'createCategory']);
    Route::put('/user-inactivate/{id}',[SuperAdminController::class,'inactivateUser']);
    Route::put('/user-role/{id}',[SuperAdminController::class,'editUserRole']);
    Route::put('/user-activate/{id}',[SuperAdminController::class,'activateUser']);
    Route::put('/category-inactivate/{id}',[SuperAdminController::class,'inactivateCategory']);
    Route::put('/category-activate/{id}',[SuperAdminController::class,'activateCategory']);
    Route::delete('/delete-category/{id}',[SuperAdminController::class,'deleteCategoryById']);
});
