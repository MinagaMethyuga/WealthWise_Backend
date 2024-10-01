<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[
    \App\Http\Controllers\Auth\AuthenticationController::class,
    'CreatUser'
]);

Route::post('/login',[
    \App\Http\Controllers\Auth\AuthenticationController::class,
    'LoginUser'
]);

Route::post('/details',[
    \App\Http\Controllers\Details\accountDetailsController::class,
    'Useraccount'
]);

Route::get('/homeCard',[
    \App\Http\Controllers\Details\accountDetailsController::class,
    'UpdateCard'
]);

Route::post('/addincome',[
    \App\Http\Controllers\Details\accountDetailsController::class,
    'addIncome'
]);

Route::post('/addexpense',[
    \App\Http\Controllers\Details\accountDetailsController::class,
    'addExpense'
]);

