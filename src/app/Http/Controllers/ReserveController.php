<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
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

        $roleCheck = ($user && $user->role === 3);

        return view('reserve', compact('user', 'shop', 'roleCheck'));
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
