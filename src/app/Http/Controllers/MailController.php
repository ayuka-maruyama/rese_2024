<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\SendMailToOwner;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function openMail(Request $request)
    {
        $user = Auth::user();

        $owner = User::find($request->id);

        return view('admin.email', compact('user', 'owner'));
    }

    public function sendEmailToOwner(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $subjectLine = $request->input('subject'); // 件名
        $bodyContent = $request->input('body'); // 本文を取得

        // メール送信
        Mail::to($user->email)->send(new SendMailToOwner($user, $subjectLine, $bodyContent));

        return redirect()->back()->with('success', 'メールを送信しました');
    }
}
