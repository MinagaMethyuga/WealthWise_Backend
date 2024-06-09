<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = \App\Models\User::all(); // Fetch all users from the database
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

Route::delete('/dashboard', 'App\Http\Controllers\Auth\AuthenticationController@destroy')->name('dashboard.destroy');
