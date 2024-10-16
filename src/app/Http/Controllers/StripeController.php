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
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = $request->input('stripeToken');
        $email = Auth::user()->email;
        $amount = 4000 * $request->input('number_gest');

        try {
            // 顧客の取得または作成
            $customer = \Stripe\Customer::create([
                'email' => $email,
                'source' => $token, // 顧客を作成する際にカード情報を指定
            ]);

            // 決済処理
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'customer' => $customer->id, // 作成した顧客IDを使用
                'description' => 'Rese',
                'receipt_email' => $email,
            ]);

            // 予約情報の保存
            Reservation::create([
                'user_id' => Auth::id(),
                'shop_id' => $request->shop_id,
                'date' => $request->date,
                'time' => $request->time,
                'number_gest' => $request->number_gest,
            ]);

            return redirect('/done')->with('success', '決済が完了しました。');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => '決済に失敗しました: ' . $e->getMessage()]);
        }
    }
}
