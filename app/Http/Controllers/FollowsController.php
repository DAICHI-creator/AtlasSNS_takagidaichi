<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class FollowsController extends Controller
{
    // フォローする
    public function follow(User $user)
    {
        Auth::user()->follows()->attach($user->id);
        return redirect()->route('search')->with('message', 'フォローしました！');
    }

    // フォロー解除する
    public function unfollow(User $user)
    {
        Auth::user()->follows()->detach($user->id);
        return redirect()->route('search')->with('message', 'フォローを解除しました！');
    }

    // フォローリスト画面
    public function followList()
    {
        // 自分がフォローしているユーザーのID一覧を取得
        $followedUserIds = Auth::user()->follows()->pluck('followed_id');

        // フォローしているユーザーたちのデータを取得
        $followedUsers = User::whereIn('id', $followedUserIds)->get();

        // フォローしているユーザーたちの投稿を取得
        $followedPosts = Post::whereIn('user_id', $followedUserIds)
            ->latest()
            ->get();

        return view('follows.followlist', compact('followedUsers', 'followedPosts'));
    }

    // フォロワーリスト画面
    public function followerList()
    {
        // 自分をフォローしているユーザーのID一覧を取得
        $followerUserIds = Auth::user()->followers()->pluck('following_id');

        // フォロワーのユーザーたちのデータを取得
        $followerUsers = User::whereIn('id', $followerUserIds)->get();

        // フォロワーたちの投稿を取得
        $followerPosts = \App\Models\Post::whereIn('user_id', $followerUserIds)
            ->latest()
            ->get();

        return view('follows.followerlist', compact('followerUsers', 'followerPosts'));
    }
}
