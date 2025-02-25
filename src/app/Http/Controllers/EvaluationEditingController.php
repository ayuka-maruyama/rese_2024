<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EvaluationEditingController extends Controller
{
    public function evaluationEditingOpen($shop_id)
    {
        $user = Auth::user();

        $shop = Shop::with('area', 'genre', 'evaluation')->find($shop_id);

        if (! $shop) {
            abort(404, '店舗が見つかりません');
        }

        $existingEvaluation = $shop->evaluation()->where('user_id', $user->id)->first();

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        return view('evaluation', compact('user', 'shop', 'existingEvaluation', 'favoriteShopIds'));
    }

    public function update(EvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->evaluation = $request->input('evaluation');
        $evaluation->comment = $request->input('comment');

        $user = Auth::user();

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'shop' . $request->input('shop_id') . '_user' . $user->id . '.' . $extension;
            $filePath = 'public/evaluation-images/' . $fileName;

            $oldImagePath = $evaluation->image_url ? str_replace('storage/', 'public/', $evaluation->image_url) : null;
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $file->storeAs('public/evaluation-images/', $fileName);

            $evaluation->image_url = 'storage/evaluation-images/' . $fileName;
        }

        $evaluation->save();

        return redirect()->route('shop.detail', ['shop_id' => $request->input('shop_id')]);
    }
    public function delete(Request $request)
    {
        $evaluationId = $request->input('evaluation_id');

        $evaluation = Evaluation::find($evaluationId);

        // 評価が存在すれば処理
        if ($evaluation) {
            // shop_idを評価から取得
            $shopId = $evaluation->shop_id;

            // 評価削除
            $evaluation->delete();

            // 正しいshop_idを渡してリダイレクト
            return redirect()->route('shop.detail', ['shop_id' => $shopId])->with('message', '口コミが削除されました');
        }

        // 評価が見つからない場合、エラーメッセージを返す
        return redirect()->back()->with('error', '口コミが見つかりませんでした');
    }
}
