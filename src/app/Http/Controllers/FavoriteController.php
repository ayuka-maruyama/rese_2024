<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::with('area', 'genre')->get(); // 必要に応じてショップデータを取得

        // 現在のユーザーのお気に入りショップIDを配列で取得
        $favoriteShopIds = Favorite::where('user_id', $user->id)
            ->pluck('shop_id')
            ->toArray();

        return view('shop.index', compact('shops', 'favoriteShopIds'));
    }

    public function toggleFavorite(Request $request, Shop $shop)
    {
        $user = Auth::user();

        // お気に入りが既に存在するか確認
        $favorite = Favorite::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->first();

        if ($favorite) {
            // 既にお気に入りに追加されている場合は削除
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // お気に入りに追加
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shop->id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
