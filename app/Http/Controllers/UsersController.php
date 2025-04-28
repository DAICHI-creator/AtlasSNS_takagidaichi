<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = User::query();

        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%');
        }

        $query->where('id', '!=', Auth::id());

        $users = $query->get();

        return view('users.search', compact('users', 'keyword'));
    }

    public function show(User $user)
    {
        $posts = $user->posts()->latest()->get();
        return view('users.show', compact('user', 'posts'));
    }
}
