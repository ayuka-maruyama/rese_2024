<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('area', 'genre', 'evaluation')->inRandomOrder()->get();

        foreach ($shops as $shop) {
            if ($shop->evaluation && $shop->evaluation->count() > 0) {
                $averageRating = $shop->evaluation->avg('evaluation');
                $shop->average_rating = number_format($averageRating, 2);
            } else {
                $shop->average_rating = '0.00';
            }
        }

        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        return view('shop', compact('shops', 'areas', 'genres', 'user', 'favoriteShopIds'));
    }
}
