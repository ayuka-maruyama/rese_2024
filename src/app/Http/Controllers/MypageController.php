<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // お気に入りの店舗IDリストを配列で取得
        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        // お気に入りの店舗情報を取得
        $favoriteShops = Shop::whereIn('id', $favoriteShopIds)->with('area', 'genre')->get();

        // 予約情報の店舗IDを取得
        $reservations = $user ? Reservation::where('user_id', $user->id)->with('shop')->get() : [];

        return view('mypage', compact('user', 'favoriteShops', 'favoriteShopIds', 'reservations'));
    }
}
