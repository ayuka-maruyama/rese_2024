<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;

// TOP画面の表示
Route::get('/', [ShopController::class, 'index']);

// 新規会員登録
Route::get('/register', [RegisterController::class, 'open'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// サンクスページの表示
Route::get('/thanks', function () {
    return view('auth.confirm');
});

// ログイン、ログアウト
Route::get('/login', [LoginController::class, 'open'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


// 認証済みユーザーのみアクセス可能
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});





/*  メール認証用ルート（基本実装項目が終わったら再度取り掛かる）
    9･7現在メール認証のメールは遅れるが、認証ボタンを押してもDBに反映されない状況

Route::get('/email/verify', function () {
    return view('auth.confirm');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); //ここでメール認証後のリダイレクト先を変更可能
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

*/