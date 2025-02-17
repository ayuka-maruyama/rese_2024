<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();

        $shop = Shop::with('area', 'genre', 'evaluation')->find($request->shop_id);

        if (!$shop) {
            abort(404);
        }

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        return view('evaluation', compact('user', 'shop', 'favoriteShopIds'));
    }

    public function store(EvaluationRequest $request)
    {
        $userId = Auth::user()->id;

        Evaluation::create([
            'user_id' => $userId,
            'shop_id' => $request->input('shop_id'),
            'evaluation' => $request->input('evaluation'),
            'comment' => $request->input('comment'),
            'image_url' => $request->input('image_url'),
        ]);

        return redirect()->route('evaluation.thanks');
    }
}
