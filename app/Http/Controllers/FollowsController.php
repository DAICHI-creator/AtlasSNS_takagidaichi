<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowsController extends Controller
{
    // フォローする
    public function follow(User $user)
    {
        Auth::user()->follows()->attach($user->id);
        return back()->with('message', 'フォローしました！');
    }

    // フォロー解除する
    public function unfollow(User $user)
    {
        Auth::user()->follows()->detach($user->id);
        return back()->with('message', 'フォローを解除しました！');
    }

    // フォローリストページ表示
    public function followList()
    {
        $user = Auth::user();
        $followUsers = $user->follows()->get();

        return view('follows.followList', compact('followUsers'));
    }

    // フォロワーリストページ表示
    public function followerList()
    {
        $user = Auth::user();
        $followerUsers = $user->followers()->get();

        return view('follows.followerList', compact('followerUsers'));
    }
}
