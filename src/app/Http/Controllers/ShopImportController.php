<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopImportRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.shop-import');
    }

    public function downloadTemplate()
    {
        $headers = ['店舗名', 'エリア', 'ジャンル', '店舗概要', '画像ファイル名', '店舗管理者名'];
        $csvContent = implode(',', $headers) . "\n";
        $csvContent = mb_convert_encoding($csvContent, 'SJIS-WIN', 'UTF-8');
        return response($csvContent)->withHeaders([
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"shop_template.csv\"",
        ]);
    }

    public function import(ShopImportRequest $request)
    {
        $csvFile = $request->file('csv_file');
        $fileContents = file_get_contents($csvFile->getRealPath());
        $encoding = mb_detect_encoding($fileContents, ['UTF-8', 'SJIS', 'EUC-JP', 'ISO-2022-JP']);
        if ($encoding !== 'UTF-8') {
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', $encoding);
        }

        $lines = explode("\n", trim($fileContents));
        $csvData = array_map('str_getcsv', $lines);
        array_shift($csvData); // ヘッダー行を削除

        $areas = Area::pluck('id', 'area_name')->toArray();
        $genres = Genre::pluck('id', 'genre_name')->toArray();

        $shops = [];
        $errors = [];

        foreach ($csvData as $index => $row) {
            if (count($row) < 6) continue;

            $shopData = [
                'shop_name' => trim($row[0] ?? ''),
                'area' => trim($row[1] ?? ''),
                'genre' => trim($row[2] ?? ''),
                'summary' => trim($row[3] ?? ''),
                'image_url' => trim($row[4] ?? ''),
                'user_id' => trim($row[5] ?? ''),
            ];

            // 各行に対してバリデーション
            $validator = Validator::make($shopData, [
                'shop_name' => 'required|string|max:50',
                'area' => 'required|string|in:東京都,大阪府,福岡県',
                'genre' => 'required|string|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                'summary' => 'required|string|max:400',
                'image_url' => ['required', 'string', 'regex:/\.(jpg|jpeg|png)$/i', 'url'],
                'user_id' => 'required|string|max:50',
            ], [
                'shop_name.required' => '店舗名を入力してください。',
                'shop_name.string' => '店舗名は文字列で入力してください。',
                'shop_name.max' => '店舗名は50文字以内で入力してください。',
                'area.required' => '地域を入力してください。',
                'area.string' => '地域は文字列で入力してください。',
                'area.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを指定してください。',
                'genre.required' => 'ジャンルを入力してください。',
                'genre.string' => 'ジャンルは文字列で入力してください。',
                'genre.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを指定してください。',
                'summary.required' => '店舗概要を入力してください。',
                'summary.string' => '店舗概要は文字列で入力してください。',
                'summary.max' => '店舗概要は400文字以内で入力してください。',
                'image_url.required' => '画像ファイル名を入力してください。',
                'image_url.string' => '画像ファイル名は文字列で入力してください。',
                'image_url.regex' => '画像ファイル名はjpg, jpeg, pngのいずれかの形式にしてください。',
                'image_url.url' => '画像URLが正しくありません。',
                'user_id.required' => '店舗管理者名を入力してください。',
                'user_id.string' => '店舗管理者名は文字列で入力してください。',
                'user_id.max' => '店舗管理者名は50文字以内で入力してください。',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $msg) {
                    $errors[] = "行 " . ($index + 2) . ": " . $msg;
                }
                continue;
            }

            // ユーザーID、エリア、ジャンルのIDを取得
            $userId = is_numeric($shopData['user_id']) ? intval($shopData['user_id']) : User::where('name', $shopData['user_id'])->value('id') ?? Auth::id();
            $areaId = $areas[$shopData['area']] ?? null;
            $genreId = $genres[$shopData['genre']] ?? null;

            if (!$areaId || !$genreId) {
                $errors[] = "行 " . ($index + 2) . ": エリアまたはジャンルが不正です";
                continue;
            }

            $shops[] = [
                'shop_name' => $shopData['shop_name'],
                'area_id' => $areaId,
                'genre_id' => $genreId,
                'summary' => $shopData['summary'],
                'image' => $shopData['image_url'],
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($errors)) {
            return back()->withErrors($errors);
        }

        if (!empty($shops)) {
            Shop::insert($shops);
        }

        return back()->with('success', '店舗情報を一括登録しました！');
    }
}
