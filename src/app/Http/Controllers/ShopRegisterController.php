<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRegisterRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;


class ShopRegisterController extends Controller
{
    public function openShopRegister()
    {
        $user = Auth::user();
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner.shop-register', compact('user', 'areas', 'genres'));
    }

    public function createShopRegister(ShopRegisterRequest $request)
    {
        $userId = $request->user_id;

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('public/shop-images');
            $fileName = basename($filePath);
        } else {
            $fileName = null;
        }

        $shop = Shop::create([
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'summary' => $request->summary,
            'image' => 'storage/shop-images/' . $fileName,
            'user_id' => $userId,
        ]);

        return view('owner.shop-created', compact('shop'));
    }
}
