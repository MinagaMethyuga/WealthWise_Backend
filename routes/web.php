<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction; // Ensure you include the Transaction model


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $account = \App\Models\Accounts::where('user_id', $user->id)->first();

        // Fetch recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(10) // Get the last 10 transactions, adjust as necessary
            ->get();

        if ($user->email == 'admin123@gmail.com' && Hash::check('Admin123', $user->password)) {
            $userCount = \App\Models\User::count();
            return view('dashboard', compact('userCount'));
        } else {
            $userfirst_name = $user->first_name;
            $userlast_name = $user->last_name;
            $userEmail = $user->email;

            $useraccountName = $account->account_name;
            $accountbalance = $account->account_balance;
            $Income = $account->monthly_income;
            $expense = $account->total_expenses;

            return view('user_dashboard', compact(
                'userfirst_name',
                'userEmail',
                'userlast_name',
                'useraccountName',
                'accountbalance',
                'Income',
                'expense',
                'recentTransactions' // Pass recent transactions to the view
            ));
        }
    })->name('dashboard');

    Route::get('/dashboard/user_list_dashboard', 'App\Http\Controllers\WebControllers\UserControler@ShowUserList')->name('user_list_dashboard');

    Route::get('/income-data', [ChartController::class, 'getIncomeData']);
    Route::get('/expense-data', [ChartController::class, 'getExpenseData']);
    Route::get('/money-flow-data', [ChartController::class, 'getMoneyFlowData']);
});
