<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;

class ShopImportRequest extends FormRequest
{
    // private $areaMap = [];
    // private $genreMap = [];
    // private $userMap = [];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // ZIPファイルのバリデーション
            'zip_file' => 'required|file|mimes:zip|max:10240',

            // CSVデータのバリデーション
            // '*.店舗名' => 'required|string|max:50',
            // '*.エリア' => 'required|in:' . implode(',', array_keys($this->areaMap)),
            // '*.ジャンル' => 'required|in:' . implode(',', array_keys($this->genreMap)),
            // '*.店舗概要' => 'required|string|max:400',
            // '*.画像ファイル名' => 'required|string|mimes:jpg,jpeg,png',
            // '*.店舗管理者' => 'required|in:' . implode(',', array_keys($this->userMap)),
        ];
    }

    public function messages()
    {
        return [
            'zip_file.required' => 'ZIPファイルをアップロードしてください',
            'zip_file.file' => '有効なファイルを選択してください',
            'zip_file.mimes' => 'ZIPファイルのみアップロードできます',
            'zip_file.max' => 'ファイルサイズは10MB以下にしてください',

            // '*.店舗名.required' => '店舗名は必須です',
            // '*.エリア.required' => '地域は必須です',
            // '*.エリア.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを指定してください',
            // '*.ジャンル.required' => 'ジャンルは必須です',
            // '*.ジャンル.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを指定してください',
            // '*.店舗概要.required' => '店舗概要は必須です',
            // '*.画像ファイル名.required' => '画像ファイル名は必須です',
            // '*.画像ファイル名.mimes' => '画像ファイルはjpg、jpeg、pngのいずれかである必要があります',
            // '*.店舗管理者.required' => '店舗管理者は必須です',
            // '*.店舗管理者.in' => '店舗管理者の名前が正しくありません',
        ];
    }

    // protected function prepareForValidation()
    // {
        // DBからエリア、ジャンル、ユーザーの対応表を取得
        // $this->areaMap = Area::pluck('id', 'area_name')->toArray();
        // $this->genreMap = Genre::pluck('id', 'genre_name')->toArray();
        // $this->userMap = User::pluck('id', 'name')->toArray();

        // データを設定
        // $this->merge([
        //     'areaMap' => $this->areaMap,
        //     'genreMap' => $this->genreMap,
        //     'userMap' => $this->userMap,
        // ]);
    // }
}
