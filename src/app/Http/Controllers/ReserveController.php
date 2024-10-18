<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest; // 追加


class ReserveController extends Controller
{
    // アクセスしているIDをキーにその詳細情報を取得する
    public function detail($shop_id)
    {
        $user = Auth::user();

        // $shop_id から対応するショップを取得
        $shop = Shop::find($shop_id);

        // もし存在しない店舗IDが指定された場合の処理
        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        // dd($user, $shop);

        // ビューに店舗情報を渡す
        return view('reserve', compact('user', 'shop'));
    }

    // public function submitReservation(ReservationRequest $request)
    // {
    //     // ログインユーザーの確認
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect('/login'); // 未ログインの場合、ログインページへリダイレクト
    //     }
    //     // 確認ページへのリダイレクト
    //     return redirect()->route('payment.show')->withInput($request->validated());
    // }

    // StripeControllerへ移行
    // public function store(ReservationRequest $request) // ReservationRequestを使う
    // {
    //     $user = Auth::user(); // ログインユーザーがいるか確認

    //     if (!$user) {
    //         return redirect('/login');
    //     } else {
    //         // reservation::create([
    //         //     'user_id' => Auth::id(),  // ログインしているユーザーのIDを取得
    //         //     'shop_id' => $request->shop_id,
    //         //     'date' => $request->date,
    //         //     'time' => $request->time,
    //         //     'number_gest' => $request->number_gest,
    //         // ]);

    //         // // /done ページへリダイレクト
    //         // return redirect('/done');
    //         $shop = Shop::find($request->shop_id);

    //         $unitPrice = 4000;
    //         $totalAmount = $unitPrice * $request->number_gest;


    //         return view('payment', compact('user', 'shop', 'request', 'unitPrice', 'totalAmount'));
    //     }
    // }

    public function delete(Request $request)
    {
        // リクエストから予約IDを取得する
        $reservationId = $request->input('reservation_id');

        // 予約データを検索して削除
        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            $reservation->delete();
        }

        // マイページへリダイレクト
        return redirect()->back();
    }
}
