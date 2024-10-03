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
            return redirect('/');
        }

        abort(403, 'This link is invalid.');
    }
}
