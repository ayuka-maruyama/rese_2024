<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::with('area', 'genre')->get();

        $favoriteShopIds = Favorite::where('user_id', $user->id)
            ->pluck('shop_id')
            ->toArray();

        return view('shop.index', compact('shops', 'favoriteShopIds'));
    }

    public function toggleFavorite(Shop $shop)
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shop->id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
