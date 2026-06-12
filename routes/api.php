<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\TargetController;
Use App\Http\Controllers\MenuController;
Use App\Http\Controllers\AuthController;
Use App\Http\Controllers\UserController;
Use App\Http\Controllers\ProfileController;

Route::prefix('auth')->group(function(){
    Route::post('signin', [AuthController::class, 'signin']);
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->middleware('cookies:admin,nutritionist');
});

Route::prefix('profile')->middleware(['cookies:admin,nutritionist'])->group(function(){
    Route::post('update', [ProfileController::class, 'update']);
    Route::get('/', [ProfileController::class, 'index']);
});

Route::middleware(['cookies:admin'])->group(function(){
    Route::resource('users', UserController::class);

    Route::get('groups', [TargetController::class, 'index'])->name('groups.find');
});