<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\AuthController;
Use App\Http\Controllers\UserController;

Route::prefix('auth')->group(function(){
    Route::post('signin', [AuthController::class, 'signin']);
    // Route::post('signup', [AuthController::class, 'signup']);
});

Route::middleware(['cookies:admin'])->group(function(){
    Route::resource('users', UserController::class);
});