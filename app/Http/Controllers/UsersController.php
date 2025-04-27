<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ←忘れずに追加！

class UsersController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = User::query();

        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%');
        }

        $users = $query->where('id', '!=', Auth::id())->get(); // 自分は除外

        return view('users.search', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
