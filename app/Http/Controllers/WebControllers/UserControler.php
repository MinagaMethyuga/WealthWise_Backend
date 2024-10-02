<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function ShowUserList(){
        $users = \App\Models\User::all();
        return view('user_list_dashboard', compact('users'));
    }
    public function destroy(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }

}
