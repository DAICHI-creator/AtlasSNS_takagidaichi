<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // ↓ ここを修正
    Route::get('login',    [AuthenticatedSessionController::class, 'create'])
         ->name('login');        // ← 名前を付与
    Route::post('login',   [AuthenticatedSessionController::class, 'store'])
         ->name('login.post');   // ← 名前を付けておくと便利

    Route::get('register', [RegisteredUserController::class, 'create'])
         ->name('register');     // ← 名前を付与
    Route::post('register',[RegisteredUserController::class, 'store'])
         ->name('register.post');

    Route::get('added',    [RegisteredUserController::class, 'added'])
         ->name('added');
});
