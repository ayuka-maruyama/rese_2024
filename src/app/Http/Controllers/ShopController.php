<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('area', 'genre')->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        return view('shop', compact('shops', 'areas', 'genres', 'user', 'favoriteShopIds'));
    }
}
