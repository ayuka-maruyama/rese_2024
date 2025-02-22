<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function showPaymentPage(ReservationRequest $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/login');
        }

        $shop = Shop::find($request->shop_id);
        $unitPrice = 4000;
        $totalAmount = $unitPrice * $request->number_gest;

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
            $customer = \Stripe\Customer::create([
                'email' => $email,
                'source' => $token,
            ]);

            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'customer' => $customer->id,
                'description' => 'Rese',
                'receipt_email' => $email,
            ]);

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
