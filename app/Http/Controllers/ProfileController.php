<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('auth.profile'); // viewのパスは合わせてね
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $validated = $request->validate([
            'username' => 'required|string|min:2|max:12',
            'email' => [
                'required',
                'email',
                'min:5',
                'max:40',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => [
                'required_with:password_confirmation',
                'nullable',
                'alpha_num',
                'min:8',
                'max:20',
                'confirmed',
            ],
            'bio' => 'nullable|string|max:150',
            'icon_image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
        ]);

        // データ更新
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'];

        // パスワード変更がある場合のみ
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // アイコン画像アップロードがある場合のみ
        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('images', 'public');
            $user->icon_image = basename($path);
        }

        $user->save();

        return redirect()->route('top');
    }
}
