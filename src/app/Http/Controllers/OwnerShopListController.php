<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;


class OwnerShopListController extends Controller
{
    public function openShopList(Request $request)
    {
        // 該当ユーザーを取得
        $user = User::find($request->id);

        // 該当ユーザーが管理している店舗を取得
        $shops = Shop::where('user_id', $user->id)->get();

        // ユーザーと店舗データをビューに渡す
        return view('admin.shop-list', compact('user', 'shops'));
    }
}
