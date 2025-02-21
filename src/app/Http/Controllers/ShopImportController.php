<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopImportRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ShopImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.shop-import');
    }

    public function import(ShopImportRequest $request)
    {
        // ZIPファイルのアップロードと解凍
        if (!$request->hasFile('zip_file')) {
            return back()->withErrors(['zip_file' => 'ZIPファイルがアップロードされていません。']);
        }

        $zipFile = $request->file('zip_file');
        $zipPath = $zipFile->store('temp'); // 一時保存
        $extractPath = storage_path('app/temp/unzipped_' . uniqid());

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zipPath)) === true) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            return back()->withErrors(['zip_file' => 'ZIPファイルの解凍に失敗しました。']);
        }

        // CSVファイルの読み込み
        $csvFilePath = glob($extractPath . '/*.csv')[0] ?? null;
        if (!$csvFilePath || !file_exists($csvFilePath)) {
            return back()->withErrors(['csv_file' => 'CSVファイルが見つかりません。']);
        }

        // CSVの文字コードを判定し、UTF-8へ変換
        $fileContents = file_get_contents($csvFilePath);
        $encoding = mb_detect_encoding($fileContents, ['UTF-8', 'SJIS', 'EUC-JP', 'ISO-2022-JP']);
        if ($encoding !== 'UTF-8') {
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', $encoding);
        }

        // 文字コードを変換したCSVデータを配列に変換
        $lines = explode("\n", $fileContents);
        $csvData = array_map('str_getcsv', $lines);
        array_shift($csvData); // ヘッダー行を削除

        // DBからエリアとジャンルのマッピングを取得
        $areas = Area::pluck('id', 'area_name')->toArray();
        $genres = Genre::pluck('id', 'genre_name')->toArray();

        $shops = [];
        $errors = [];

        foreach ($csvData as $row) {
            if (count($row) < 6) continue; // データ不足の場合はスキップ

            $shopData = [
                'shop_name' => trim($row[0] ?? ''),
                'area' => trim($row[1] ?? ''),
                'genre' => trim($row[2] ?? ''),
                'summary' => trim($row[3] ?? ''),
                'image_name' => trim($row[4] ?? ''),
                'user_id' => trim($row[5] ?? ''),
            ];

            // user_idが数値ならそのまま使用
            if (is_numeric($shopData['user_id'])) {
                $userId = intval($shopData['user_id']);
            } else {
                // ユーザー名で検索し、該当するIDを取得（なければ現在の管理者IDを使用）
                $userId = User::where('name', $shopData['user_id'])->value('id') ?? Auth::id();
            }

            Log::info('取得した user_id:', ['csv_value' => $shopData['user_id'], 'converted_id' => $userId]);

            // エリアとジャンルのIDを取得
            $areaId = $areas[$shopData['area']] ?? null;
            $genreId = $genres[$shopData['genre']] ?? null;

            if (!$areaId || !$genreId) {
                $errors[] = "エリアまたはジャンルが不正です: {$shopData['area']}, {$shopData['genre']}";
                continue;
            }

            // 画像の存在チェック
            $imagePath = $extractPath . '/' . $shopData['image_name'];
            if (!file_exists($imagePath)) {
                $errors[] = "画像ファイルが見つかりません: {$shopData['image_name']}";
                continue;
            }

            // 画像を保存
            $newImagePath = 'shop-images/' . basename($shopData['image_name']);
            Storage::disk('public')->put($newImagePath, file_get_contents($imagePath));

            // 登録データ作成
            $shops[] = [
                'shop_name' => $shopData['shop_name'],
                'area_id' => $areaId,
                'genre_id' => $genreId,
                'summary' => $shopData['summary'],
                'image' => 'storage/' . $newImagePath,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // バリデーションエラーがなければ登録
        if (!empty($shops)) {
            Shop::insert($shops);
        }

        // 終了処理（ZIP解凍フォルダを削除）
        Storage::deleteDirectory($extractPath);
        Storage::delete($zipPath);

        // エラーがあればメッセージを返す
        if (!empty($errors)) {
            return back()->withErrors(['import_errors' => $errors]);
        }

        return back()->with('success', '店舗情報を一括登録しました！');
    }
}
