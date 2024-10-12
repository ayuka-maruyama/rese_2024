<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Reservation; // Reservationモデルのインポート
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function charge(Request $request)
    {
        // Stripeの秘密鍵をセット
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // フォームから人数を取得
        $numberOfGuests = $request->input('number_gest');

        // 1人あたりの単価（例: 100円）
        $unitPrice = 4000;

        // 合計金額を計算
        $totalAmount = $unitPrice * $numberOfGuests;

        // StripeのCharge APIを使って支払いを作成
        $charge = Charge::create([
            'amount' => $totalAmount, // Stripeでは金額は「最小通貨単位」（円なら「円」）で指定
            'currency' => 'jpy',
            'source' => $request->stripeToken,
        ]);

        // ログインユーザーの確認
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        // 予約情報の保存
        Reservation::create([
            'user_id' => $user->id,  // ログインしているユーザーのIDを取得
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number_gest' => $numberOfGuests,
        ]);

        // 予約完了ページへリダイレクト
        return redirect('/done');
    }
}
