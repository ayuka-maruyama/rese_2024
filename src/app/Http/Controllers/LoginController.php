<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function open()
    {
        return view('auth/login');
    }

    public function store(LoginRequest $request)
    {
        // 認証を試みる
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 修正: ロールに応じたリダイレクト先を正しく設定
            if ($user->role == 1) { // role = 1 の場合
                return redirect('/admin/dashboard');
            } elseif ($user->role == 2) { // role = 2 の場合
                return redirect('/owner/dashboard');
            } elseif ($user->role == 3) { // role = 3 の場合
                return redirect('/mypage');
            }
        }

        // 認証失敗時の処理
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
