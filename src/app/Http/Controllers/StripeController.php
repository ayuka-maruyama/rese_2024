<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Reservation; // Reservationモデルのインポート
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest; // 追加


class StripeController extends Controller
{
    public function showPaymentPage(ReservationRequest $request)
    {
        $user = Auth::user();
        $shop = Shop::find($request->shop_id);
        $unitPrice = 4000;
        $totalAmount = $unitPrice * $request->number_gest; // 合計金額の計算

        // 支払いページを表示
        return view('payment', [
            'user' => $user,
            'shop' => $shop,
            'request' => $request,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function charge(Request $request)
    {
        // Stripeの秘密キーをセット
        Stripe::setApiKey(config('services.stripe.secret'));

        // フォームから送信されたトークンを取得
        $token = $request->input('stripeToken');

        // 決済金額（セント単位：例 4000円 = 400000）
        $amount = 4000 * $request->input('number_gest');

        try {
            // Stripeの決済を実行
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'source' => $token,
                'description' => 'Reservation payment'
            ]);

            // 予約情報の保存
            $user = Auth::user();
            Reservation::create([
                'user_id' => $user->id,
                'shop_id' => $request->shop_id,
                'date' => $request->date,
                'time' => $request->time,
                'number_gest' => $request->number_gest,
            ]);

            // 成功メッセージとともに確認ページへリダイレクト
            return redirect('/done')->with('success', '決済が完了しました。');
        } catch (\Exception $e) {
            // エラーメッセージとともに元のページにリダイレクト
            return back()->withErrors(['message' => '決済に失敗しました: ' . $e->getMessage()]);
        }
    }

    // // Stripeの秘密鍵をセット
    // Stripe::setApiKey(env('STRIPE_SECRET'));

    // // フォームから人数を取得
    // $numberOfGuests = $request->input('number_gest');

    // // 1人あたりの単価
    // $unitPrice = 4000;

    // // 合計金額を計算
    // $totalAmount = $unitPrice * $numberOfGuests;

    // // 支払い処理
    // try {
    //     $charge = Charge::create([
    //         'amount' => $totalAmount,
    //         'currency' => 'jpy',
    //         'source' => $request->stripeToken,
    //     ]);

    //     // ログインユーザーの確認
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect('/login');
    //     }

    // // 予約情報の保存
    // Reservation::create([
    //     'user_id' => $user->id,
    //     'shop_id' => $request->shop_id,
    //     'date' => $request->date,
    //     'time' => $request->time,
    //     'number_gest' => $numberOfGuests,
    // ]);

    //     // 予約完了ページへリダイレクト
    //     return redirect('/done');
    // } catch (\Exception $e) {
    //     return back()->withErrors(['error' => '支払いに失敗しました: ' . $e->getMessage()]);
    // }
}
