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

        $existingEvaluation = $shop->evaluation()->where('user_id', $user->id)->first();
        if ($existingEvaluation) {
            return back()->with('message', '口コミ投稿済みのため「口コミを編集」から変更してください！');
        }

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        return view('evaluation', compact('user', 'shop', 'favoriteShopIds'));
    }

    public function store(EvaluationRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'shop' . $request->shop_id . '_user' . $user->id . '.' . $extension;
            $filePath = 'storage/evaluation-images/' . $fileName;

            // storage/app/public/evaluation-images に保存
            $file->storeAs('public/evaluation-images/', $fileName);
        } else {
            $filePath = null;
        }

        Evaluation::create([
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
            'image_url' => $filePath,
        ]);

        return redirect()->route('evaluation.thanks');
    }
}
