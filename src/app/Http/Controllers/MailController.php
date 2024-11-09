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
        $subjectLine = $request->input('subject');
        $bodyContent = $request->input('body');

        foreach ($users as $user) {
            Mail::to($user->email)->send(new sendEmailToUser($user, $subjectLine, $bodyContent));
        }

        return redirect()->route('admin.dashboard')->with('success', 'メールを送信しました');
    }
}
