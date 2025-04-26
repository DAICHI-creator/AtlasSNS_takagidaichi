<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('top');
    }
    public function destroy(Request $request): RedirectResponse
    {
    // ① 本当のログアウト
    Auth::guard('web')->logout();

    // ② セッションの完全破棄と CSRF トークン再生成
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // ③ ログイン画面へ
    return redirect()->route('login');
    }
}
