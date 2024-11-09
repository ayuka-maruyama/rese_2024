<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReserveController extends Controller
{
    public function detail($shop_id)
    {
        $user = Auth::user();

        $shop = Shop::find($shop_id);

        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        return view('reserve', compact('user', 'shop'));
    }

    public function delete(Request $request)
    {
        $reservationId = $request->input('reservation_id');

        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            $reservation->delete();
        }

        return redirect()->back();
    }
}
