<?php

namespace App\Http\Controllers\Details;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transaction;

class accountDetailsController extends Controller
{
    public function Useraccount(Request $request)
    {
        return rescue(function() use ($request){
            $request->validate([
                'user_id' => 'required|numeric',
                'account_name' => 'required|string',
                'account_balance' => 'required|numeric'
            ]);

            return response()->json([
                'status' => 'success',
                'payload' => tap(Accounts::create([
                    'user_id' => $request->input('user_id'),
                    'account_name' => $request->input('account_name'),
                    'account_balance' => $request->input('account_balance')
                ]),
                ),
            ],200);
        }, function($e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],500);
        });
    }

    public function UpdateCard(Request $request)
    {
        return rescue(function () use ($request){
            $request->validate([
                'user_id' => 'required|numeric',
            ]);

            $account = Accounts::where('user_id', $request->user_id)->first();

            return response()->json([
                'status'=>'true',
                'payload'=>[
                    'account_name'=> $account->account_name,
                    'account_balance'=> $account->account_balance,
                ]
            ]);
        },function($e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],500);
        });
    }

    public function addIncome(Request $request)
    {
        return rescue(function () use ($request) {
            $request->validate([
                'user_id' => 'required|numeric',
                'income' => 'required|numeric'
            ]);

            $account = Accounts::where('user_id', $request->user_id)->first();

            if (!$account) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found for the specified user ID.'
                ], 404);
            }

            // Update the account balance and total income
            $account->account_balance += $request->income;
            $account->total_income += $request->income;
            $account->monthly_income += $request->income;
            $account->save();

            // Log the transaction
            Transaction::create([
                'user_id' => $request->user_id,
                'type' => 'income',
                'amount' => $request->income,
                'description' => 'Income added', // You can customize this
            ]);

            return response()->json([
                'status' => 'true',
                'payload' => [
                    'account_balance' => $account->account_balance,
                    'total_income' => $account->total_income,
                ]
            ]);
        }, function ($e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        });
    }

    public function addExpense(Request $request)
    {
        return rescue(function () use ($request) {
            $request->validate([
                'user_id' => 'required|numeric',
                'amount' => 'required|numeric'
            ]);

            $account = Accounts::where('user_id', $request->user_id)->first();

            if (!$account) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found for the specified user ID.'
                ], 404);
            }

            // Update the account balance and monthly expenses
            $account->account_balance -= $request->amount;
            $account->total_expenses += $request->amount;
            $account->save();

            // Log the transaction
            Transaction::create([
                'user_id' => $request->user_id,
                'type' => 'expense',
                'amount' => $request->amount,
                'description' => 'Expense deducted', // You can customize this
            ]);

            return response()->json([
                'status' => 'true',
                'payload' => [
                    'account_balance' => $account->account_balance,
                    'monthly_expenses' => $account->total_expenses,
                ]
            ]);
        }, function ($e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        });
    }

}
