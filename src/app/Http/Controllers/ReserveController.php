<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function detail($shop_id)
    {
        $user = Auth::user();

        $shop = Shop::with('area', 'genre')->find($shop_id);

        $evaluations = Evaluation::where('shop_id', $shop_id)
            ->get();

        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        $roleCheck = ($user && $user->role === 3);
        $adminRoleCheck = ($user && $user->role === 1);

        $evaluationCheck = $user
            ? Evaluation::where('user_id', $user->id)
            ->where('shop_id', $shop_id)
            ->exists()
            : false;

        return view('reserve', compact('user', 'shop', 'evaluations', 'roleCheck', 'adminRoleCheck', 'evaluationCheck'));
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
