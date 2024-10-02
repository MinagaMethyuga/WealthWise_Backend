<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\Details\accountDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Use the controller for the dashboard route
    Route::get('/dashboard', [accountDetailsController::class, 'getUserActivity'])->name('dashboard');

    Route::get('/dashboard/user_list_dashboard', 'App\Http\Controllers\WebControllers\UserControler@ShowUserList')->name('user_list_dashboard');

    Route::get('/income-data', [ChartController::class, 'getIncomeData']);
    Route::get('/expense-data', [ChartController::class, 'getExpenseData']);
    Route::get('/money-flow-data', [ChartController::class, 'getMoneyFlowData']);

    Route::get('/api/user-growth', [ChartController::class, 'getUserGrowthData']);
    Route::delete('/dashboard', [\App\Http\Controllers\WebControllers\UserControler::class, 'destroy'])->name('user.destroy');
});
