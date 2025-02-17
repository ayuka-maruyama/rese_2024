<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopUpdateRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopUpdateController extends Controller
{
    public function openShopUpdate($shop_id)
    {
        $user = Auth::user();

        if ($user->role !== 2) {
            return redirect('/');
        }

        $shop = Shop::find($shop_id);
        $areas = Area::all();
        $genres = Genre::all();

        if (!$shop) {
            return redirect()->back()->with('error', '店舗が見つかりませんでした。');
        }

        return view('owner.shop-update', compact('user', 'shop', 'areas', 'genres'));
    }

    public function update(ShopUpdateRequest $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 2) {
            return redirect('/');
        }

        $shop = Shop::findOrFail($id);

        $shop->shop_name = $request->input('shop_name', $shop->shop_name);
        $shop->area_id = $request->input('area_id', $shop->area_id);
        $shop->genre_id = $request->input('genre_id', $shop->genre_id);
        $shop->summary = $request->input('summary', $shop->summary);

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('public/shop-images');
            $fileName = basename($filePath);
            $shop->image = 'storage/shop-images/' . $fileName;
        }

        $shop->save();

        return redirect()->route('owner.dashboard')->with('success', '店舗情報が更新されました');
    }
}
