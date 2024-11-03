<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\sendEmailToUser;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function openMail(Request $request)
    {
        $user = Auth::user();

        return view('admin.email', compact('user'));
    }

    public function sendEmailToUser(Request $request)
    {
        $users = User::all();
        $subjectLine = $request->input('subject'); // 件名
        $bodyContent = $request->input('body'); // 本文を取得

        // メール送信
        foreach ($users as $user) {
            Mail::to($user->email)->send(new sendEmailToUser($user, $subjectLine, $bodyContent));
        }

        return redirect()->back()->with('success', 'メールを送信しました');
    }
}
