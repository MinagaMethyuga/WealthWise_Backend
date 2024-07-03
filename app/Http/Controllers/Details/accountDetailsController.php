<?php

namespace App\Http\Controllers\Details;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\User;
use Illuminate\Http\Request;

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
}
