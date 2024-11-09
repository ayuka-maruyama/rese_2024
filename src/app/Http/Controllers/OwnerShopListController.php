<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;


class OwnerShopListController extends Controller
{
    public function openShopList(Request $request)
    {
        $user = User::find($request->id);

        $shops = Shop::where('user_id', $user->id)->get();

        return view('admin.shop-list', compact('user', 'shops'));
    }
}
