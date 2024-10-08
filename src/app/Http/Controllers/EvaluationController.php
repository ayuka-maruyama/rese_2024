<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class EvaluationController extends Controller
{
    public function show(Request $request)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();

        // お店のIDを取得
        $shopId = $request->input('shop_id');

        // お店の情報を取得
        $shop = Shop::find($shopId);

        // お店の情報をビューに渡して表示
        return view('evaluation', compact('user', 'shopId', 'shop'));
    }
}
