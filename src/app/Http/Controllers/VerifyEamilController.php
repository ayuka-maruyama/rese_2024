<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyEamilController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/');
        }

        if ($request->hasValidSignature()) {
            $user->markEmailAsVerified();
            Auth::login($user); // ユーザーをログイン状態にする

            // ロールに基づいてリダイレクト先を指定
            switch ($user->role) {
                case 1:
                    return redirect('/admin/dashboard');
                case 2:
                    return redirect('/owner/dashboard');
                case 3:
                    return redirect('/mypage');
                default:
                    return redirect('/'); // 万が一、予期しないロールがあった場合のデフォルト
            }
        }
        abort(403, 'This link is invalid.');
    }
}
