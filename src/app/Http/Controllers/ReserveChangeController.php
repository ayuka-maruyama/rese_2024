<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ReserveChangeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $reserveNow = Reservation::where('id', $request->reservation_id)
            ->with('shop')
            ->first();

        return view('reserve-change', compact('user', 'reserveNow'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::id();

        $reserveNow = Reservation::where('id', $id)->where('user_id', $user)->first();

        if (!$reserveNow) {
            return redirect('/mypage')->withErrors('予約が見つかりませんでした');
        }

        $reserveNow->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number_gest' => $request->input('number_gest'),
        ]);

        return redirect('/mypage')->with('alert', '予約情報を更新しました');
    }
}
