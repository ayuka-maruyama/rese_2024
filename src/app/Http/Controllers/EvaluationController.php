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
        $user = Auth::user();

        $shopId = $request->input('shop_id');

        $shop = Shop::find($shopId);

        return view('evaluation', compact('user', 'shopId', 'shop'));
    }

    public function store(EvaluationRequest $request)
    {
        $userId = Auth::user()->id;

        Evaluation::create([
            'user_id' => $userId,
            'shop_id' => $request->input('shop_id'),
            'evaluation' => $request->input('evaluation'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('evaluation.thanks');
    }
}
