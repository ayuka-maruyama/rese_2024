<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\ReservationRequest; // 追加
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;


class ReserveController extends Controller
{
    // アクセスしているIDをキーにその詳細情報を取得する
    public function detail($shop_id)
    {
        // $shop_id から対応するショップを取得
        $shop = Shop::find($shop_id);

        // もし存在しない店舗IDが指定された場合の処理
        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        // ビューに店舗情報を渡す
        return view('reserve', ['shop' => $shop]);
    }

    public function store(ReservationRequest $request) // ReservationRequestを使う
    {
        $user = Auth::user(); // ログインユーザーがいるか確認

        if (!$user) {
            return redirect('/login');
        } else {
            // 予約情報の保存
            reservation::create([
                'user_id' => Auth::id(),  // ログインしているユーザーのIDを取得
                'shop_id' => $request->shop_id,
                'date' => $request->date,
                'time' => $request->time,
                'number_gest' => $request->number_gest,
            ]);

            // /done ページへリダイレクト
            return redirect('/done');
        }
    }
}
