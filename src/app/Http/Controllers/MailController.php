<?php

namespace App\Http\Controllers;

use App\Mail\sendEmailToUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function openMail(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        return view('admin.email', compact('user'));
    }

    public function sendEmailToUser(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        $users = User::where('role', 3)->get();
        $subjectLine = $request->input('subject');
        $bodyContent = $request->input('body');

        foreach ($users as $user) {
            Mail::to($user->email)->send(new sendEmailToUser($user, $subjectLine, $bodyContent));
        }

        return redirect()->route('admin.dashboard')->with('success', 'メールを送信しました');
    }
}
