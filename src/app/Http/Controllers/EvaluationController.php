<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;

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

    public function store(EvaluationRequest $request)
    {
        // ログイン済みのユーザーIDを取得
        $userId = Auth::user()->id;

        // データ保存
        Evaluation::create([
            'user_id' => $userId, // 現在のユーザーID
            'shop_id' => $request->input('shop_id'), // フォームからのshop_id
            'evaluation' => $request->input('evaluation'), // 星の評価
            'comment' => $request->input('comment'), // レビュー本文
        ]);

        // 保存完了後、リダイレクト
        return redirect()->route('evaluation.thanks');
    }
}
