<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;


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
}
