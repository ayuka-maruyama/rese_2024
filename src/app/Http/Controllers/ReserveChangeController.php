<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;

class ReserveChangeController extends Controller
{
    public function index(Request $request)
    {
        // 予約変更ページを開いたときに表示したい内容を指定する
        // 現在ログインしているユーザーを取得（予約情報をユーザーだけに絞るために必要）
        $user = Auth::user();

        // 現在の予約情報を取得
        $reserveNow = Reservation::where('id', $request->reservation_id)
            ->with('shop')
            ->first();

        return view('reserve-change', compact('user', 'reserveNow'));
    }

    public function update(Request $request, $id)
    {
        // ログインしているユーザーのIDを取得
        $user = Auth::id();

        // 更新対象の予約情報を取得
        $reserveNow = Reservation::where('id', $id)->where('user_id', $user)->first();

        // 予約情報が存在しない場合は404エラーページなどにリダイレクト
        if (!$reserveNow) {
            return redirect('/mypage')->withErrors('予約が見つかりませんでした');
        }

        // 予約情報を更新
        $reserveNow->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number_gest' => $request->input('number_gest'),
        ]);

        // 更新後、マイページにリダイレクト
        return redirect('/mypage')->with('alert', '予約情報を更新しました');
    }
}
