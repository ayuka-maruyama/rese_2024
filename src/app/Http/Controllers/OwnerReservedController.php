<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class OwnerReservedController extends Controller
{
    public function openReserved($shop_id)
    {
        $shop = Shop::find($shop_id);
        dd($shop);
        return view('owner.shop-reserved', compact('shop'));
    }
}
