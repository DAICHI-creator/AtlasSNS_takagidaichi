<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        $followedUserIds = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::whereIn('user_id', $followedUserIds)
            ->orWhere('user_id', Auth::id())
            ->latest()
            ->get();
        return view('posts.index', compact('posts'));
    }
    public function store(Request $request)
{
    // バリデーション（必要なら）
    $request->validate([
        'post_content' => 'required|string|min:1|max:150',
    ]);

    // 投稿を保存（仮で保存処理書く）
    Post::create([
        'user_id' => Auth::id(), // ログイン中のユーザーID
        'post_content' => $request->input('post_content'),
    ]);

    return redirect()->route('top')->with('message', '投稿が完了しました！');
}

    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // 自分の投稿だけ編集OK
    if ($post->user_id !== Auth::id()) {
        abort(403); // 権限エラー
    }

    // バリデーション
    $request->validate([
        'post_content' => 'required|string|min:1|max:150',
    ]);

    // 更新
    $post->update([
        'post_content' => $request->input('post_content'),
    ]);

    return redirect()->route('top')->with('message', '投稿を編集しました！');
}
    public function destroy($id)
{
    $post = Post::findOrFail($id);

    if ($post->user_id !== Auth::id()) {
        abort(403);
    }

    $post->delete();

    return redirect()->route('top')->with('message', '投稿を削除しました！');
}
}
