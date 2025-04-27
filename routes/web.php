<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::middleware('auth')->group(function () {
    // トップページ
    Route::get('top', [PostsController::class, 'index'])->name('top');

    // 自分のプロフィール／編集ページ
    Route::get('profile', [ProfileController::class, 'profile'])
         ->name('profile');

    // ユーザー検索ページ
    Route::get('search', [UsersController::class, 'search'])
         ->name('search');

    // フォロー・フォロワー一覧ページ
    Route::get('follow-list',   [FollowsController::class, 'followList'])
         ->name('follow-list');

    Route::get('follower-list', [FollowsController::class, 'followerList'])
         ->name('follower-list');

    // 他ユーザーのプロフィールページ（例: /users/1）
    Route::get('users/{user}', [UsersController::class, 'show'])
         ->name('users.show');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');

    Route::post('post', [PostsController::class, 'store'])->name('posts.store');

    Route::post('post/update/{post}', [PostsController::class, 'update'])->name('posts.update');

    Route::delete('post/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    Route::post('/follow/{user}', [FollowsController::class, 'follow'])->name('follow');

    Route::post('/unfollow/{user}', [FollowsController::class, 'unfollow'])->name('unfollow');

    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
