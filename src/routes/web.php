<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\VerifyEamilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ReserveChangeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\OwnerRegisterController;
use Illuminate\Http\Request;

// TOP画面の表示
Route::get('/', [ShopController::class, 'index'])->name('home');

// 検索
Route::get('/search', [ShopController::class, 'search'])->name('shop.search');

// 店舗詳細ページへのアクセス
Route::get('/detail/{shop_id}', [ReserveController::class, 'detail'])->name('shop.detail');

// 新規会員登録
Route::get('/register', [RegisterController::class, 'open'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// サンクスページの表示
Route::get('/thanks', function () {
    return view('auth.confirm');
});

// 予約情報ページの表示
Route::post('/payment/done', [StripeController::class, 'charge'])->name('payment.charge'); // 支払い処理を行うルート
// 支払いページの表示
Route::post('/payment', [StripeController::class, 'showPaymentPage'])->name('payment.show'); // 支払いページの表示
// stripe実装
Route::post('/payment/charge', [StripeController::class, 'charge'])->name('stripe.charge');


// レビュー画面の表示
Route::post('/evaluation', [EvaluationController::class, 'show']);

// レビュー画面の送信
Route::post('/evaluation/confirm', [EvaluationController::class, 'store'])->name('evaluation.confirm');
Route::get('/review-thanks', function () {
    return view('review-thanks');
})->name('evaluation.thanks');


// 予約完了ページの表示
Route::get('/done', function () {
    return view('reserve-confirm');
});

// 予約の削除
Route::post('/reserve-delete', [ReserveController::class, 'delete'])->name('reserve.delete');

// 予約の変更
Route::post('/reserve/change', [ReserveChangeController::class, 'index']);

// 予約の更新用のPUTメソッド
Route::put('/reservation/{id}/update', [ReserveChangeController::class, 'update'])->name('reservation.update');

// お気に入り登録
Route::post('/favorite/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');

// ログイン、ログアウト
Route::get('/login', [LoginController::class, 'open'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// 認証済みユーザーのみアクセス可能
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'openAdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/search', [AdminDashboardController::class, 'search'])->name('admin.search');
    Route::get('/admin/register', [OwnerRegisterController::class, 'openOwnerCreate'])->name('admin.owner-create');
    Route::post('/admin/register', [OwnerRegisterController::class, 'ownerRegister'])->name('admin.owner-register');
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'openOwnerDashboard'])->name('owner.dashboard');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});

// メール認証部分
Route::get('/email/verify', function () {
    return view('email-verify');
})->middleware('auth')->name('verification.notice');

Route::middleware(['signed', 'throttle:6,1'])->group(function () {
    Route::get('/email/verify/{id}/{hash}', [VerifyEamilController::class, '__invoke'])->name('verification.verify');
});

// メール再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', true);  // セッションに 'resent' フラグを追加
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// QRコード表示用のルート
Route::get('/reservation/qr/{id}', [MypageController::class, 'showQrCode'])->name('reservation.qr');

// チェックイン用のルート（既存）
Route::get('/reservation/checkin/{id}', [MypageController::class, 'checkin'])->name('reservation.checkin');
