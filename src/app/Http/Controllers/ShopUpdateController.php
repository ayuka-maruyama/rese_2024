<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopUpdateRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;


class ShopUpdateController extends Controller
{
    public function openShopUpdate($shop_id)
    {
        // リクエストから 'id' を取得
        $user = Auth::user();

        // $shop_id から対応するショップを取得
        $shop = Shop::find($shop_id);
        $areas = Area::all();
        $genres = Genre::all();

        // もし存在しない店舗IDが指定された場合の処理
        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        return view('owner.shop-update', compact('user', 'shop', 'areas', 'genres'));
    }

    public function update(ShopUpdateRequest $request, $id)
    {
        $request->validate([
            'shop_name' => 'string|max:255',
            'area_id' => 'integer',
            'genre_id' => 'integer',
            'summary' => 'string|min:20',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 該当する店舗を取得
        $shop = Shop::findOrFail($id);

        // 他のフィールドを更新
        $shop->shop_name = $request->input('shop_name', $shop->shop_name);
        $shop->area_id = $request->input('area_id', $shop->area_id);
        $shop->genre_id = $request->input('genre_id', $shop->genre_id);
        $shop->summary = $request->input('summary', $shop->summary);
        // 画像ファイルの保存処理
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('public/shop-images');
            $fileName = basename($filePath);
            $shop->image = 'storage/shop-images/' . $fileName;
        }


        // 保存
        $shop->save();

        // 更新成功時のリダイレクトとメッセージ表示
        return redirect()->route('owner.dashboard')->with('success', '店舗情報が更新されました');
    }
}
