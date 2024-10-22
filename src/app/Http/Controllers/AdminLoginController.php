<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function loginOpen()
    {
        return view('admin/admin-login');
    }

    public function login(AdminLoginRequest $request)
    {
        // デバッグ用
        Log::info('Login attempt:', $request->only('admin_email', 'admin_password'));

        if (Auth::guard('admin')->attempt([
            'admin_email' => $request->input('admin_email'),
            'password' => $request->input('admin_password')
        ])) {
            $request->session()->regenerate();

            // ログイン成功後にリダイレクト
            return redirect('/dashboard');
        }

        // 認証失敗時の処理
        return back()->withErrors([
            'admin_email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
}
