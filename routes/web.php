<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->email == 'admin123@gmail.com' && Hash::check('Admin123', $user->password)) {
            $userCount = \App\Models\User::count();
            return view('dashboard', compact('userCount'));
        } else {
            $userfirst_name = $user->first_name;
            $userlast_name = $user->last_name;
            $userEmail = $user->email;
            return view('user_dashboard', compact('userfirst_name', 'userEmail', 'userlast_name'));
        }
    })->name('dashboard');

    Route::get('/dashboard/user_list_dashboard', 'App\Http\Controllers\WebControllers\UserControler@ShowUserList')->name('user_list_dashboard');
});

Route::delete('/dashboard', 'App\Http\Controllers\Auth\AuthenticationController@destroy')->name('dashboard.destroy');

