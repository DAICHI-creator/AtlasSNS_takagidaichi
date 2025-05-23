<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
    $storageDir = storage_path('app/public/images');
    $storagePath = $storageDir . '/icon1.png';
    $publicPath = public_path('images/icon1.png');

    // ディレクトリが存在しなければ作成
    if (!File::exists($storageDir)) {
        File::makeDirectory($storageDir, 0755, true); // 再帰的に作成
    }

    // ファイルが存在しなければコピー
    if (!File::exists($storagePath)) {
        File::copy($publicPath, $storagePath);
    }

        $validated = $request->validate([
            'username'               => ['required', 'string', 'min:2', 'max:12'],
            'email'                  => ['required', 'string', 'email', 'min:5', 'max:40', 'unique:users,email'],
            'password'               => ['required', 'alpha_num', 'min:8', 'max:20'],
            'password_confirmation'  => ['required', 'alpha_num', 'min:8', 'max:20', 'same:password'],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'icon_image' => 'icon1.png',
        ]);

        session()->put('username', $user->username);

        return redirect()->route('added');
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
