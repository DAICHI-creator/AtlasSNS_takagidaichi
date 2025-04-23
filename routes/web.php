<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// 新規ユーザー登録
Route::get('/register', [RegisteredUserController::class, 'create'])
     ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログイン
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
     ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ログアウト
Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::get('top', [PostsController::class, 'index']);

Route::get('profile', [ProfileController::class, 'profile']);

Route::get('search', [UsersController::class, 'index']);

Route::get('follow-list', [PostsController::class, 'index']);
Route::get('follower-list', [PostsController::class, 'index']);
