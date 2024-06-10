<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function ShowUserList(){
        $users = \App\Models\User::all();
        return view('user_list_dashboard', compact('users'));
    }
}
