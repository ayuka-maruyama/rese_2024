<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationEditingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\OwnerRegisterController;
use App\Http\Controllers\OwnerReservedController;
use App\Http\Controllers\OwnerShopListController;
use App\Http\Controllers\OwnerUpdateController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReserveChangeController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopImportController;
use App\Http\Controllers\ShopRegisterController;
use App\Http\Controllers\ShopUpdateController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\VerifyEamilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/search', [ShopController::class, 'search'])->name('shop.search');

Route::get('/detail/{shop_id}', [ReserveController::class, 'detail'])->name('shop.detail');

Route::get('/register', [RegisterController::class, 'open'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/thanks', function () {
    return view('auth.confirm');
});

Route::get('/email/verify', function () {
    return view('email-verify');
})->middleware('auth')->name('verification.notice');

Route::middleware(['signed', 'throttle:6,1'])->group(function () {
    Route::get('/email/verify/{id}/{hash}', [VerifyEamilController::class, '__invoke'])->name('verification.verify');
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', [LoginController::class, 'open'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'openAdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/search', [AdminDashboardController::class, 'search'])->name('admin.search');
    Route::get('/admin/register', [OwnerRegisterController::class, 'openOwnerCreate'])->name('admin.owner-create');
    Route::post('/admin/register', [OwnerRegisterController::class, 'ownerRegister'])->name('admin.owner-register');
    Route::get('/admin/update/{id}', [OwnerUpdateController::class, 'openUpdate'])->name('admin.owner-update-open');
    Route::post('/admin/update/{id}', [OwnerUpdateController::class, 'update'])->name('admin.owner-update');
    Route::get('/admin/shop/{id}', [OwnerShopListController::class, 'openShopList'])->name('admin.owner-shoplist');
    Route::get('/admin/send-email', [MailController::class, 'openMail'])->name('admin.mail');
    Route::post('/admin/send-email', [MailController::class, 'sendEmailToUser'])->name('admin.sendEmail');
    Route::get('/admin/import-shops', [ShopImportController::class, 'showImportForm'])->name('shop.import.form');
    Route::post('/admin/import-shops', [ShopImportController::class, 'import'])->name('shop.import');

    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'openOwnerDashboard'])->name('owner.dashboard');
    Route::get('/owner/shop/register', [ShopRegisterController::class, 'openShopRegister'])->name('owner.shop-register');
    Route::post('/owner/shop/register', [ShopRegisterController::class, 'createShopRegister'])->name('owner.shop-create');
    Route::get('/owner/shop/update/{id}', [ShopUpdateController::class, 'openShopUpdate'])->name('owner.shop-update');
    Route::put('/owner/shop/update/{id}', [ShopUpdateController::class, 'update'])->name('owner.shop.update');
    Route::get('/owner/shop/reserved/{id}', [OwnerReservedController::class, 'openReserved'])->name('owner.reserved');

    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::get('/reservation/qr/{id}', [MypageController::class, 'showQrCode'])->name('reservation.qr');
    Route::get('/reservation/checkin/{id}', [MypageController::class, 'checkin'])->name('reservation.checkin');
    Route::post('/payment', [StripeController::class, 'showPaymentPage'])->name('payment.show');
    Route::post('/payment/charge', [StripeController::class, 'charge'])->name('stripe.charge');
    Route::get('/done', function () {
        return view('reserve-confirm');
    });
    Route::get('/evaluation', [EvaluationController::class, 'show']);
    Route::post('/evaluation', [EvaluationController::class, 'show']);
    Route::post('/evaluation/confirm', [EvaluationController::class, 'store'])->name('evaluation.confirm');
    Route::get('/review-thanks', function () {
        return view('review-thanks');
    })->name('evaluation.thanks');
    Route::get('/evaluation/editing/{shop_id}', [EvaluationEditingController::class, 'evaluationEditingOpen'])->name('evaluation.editing.open');
    Route::post('/evaluation/{evaluation}', [EvaluationEditingController::class, 'update'])->name('evaluation.update');
    Route::put('/evaluation/{evaluation}', [EvaluationEditingController::class, 'update'])->name('evaluation.update');
    Route::post('/evaluation/delete/{evaluation}', [EvaluationEditingController::class, 'delete'])->name('evaluation.delete');

    Route::post('/reserve-delete', [ReserveController::class, 'delete'])->name('reserve.delete');
    Route::post('/reserve/change', [ReserveChangeController::class, 'index']);
    Route::put('/reservation/{id}/update', [ReserveChangeController::class, 'update'])->name('reservation.update');
    Route::post('/favorite/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
});
