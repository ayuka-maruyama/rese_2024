<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopImportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'zip_file' => 'required|file|mimes:zip|max:10240',

        ];
    }

    public function messages()
    {
        return [
            'zip_file.required' => 'ZIPファイルをアップロードしてください',
            'zip_file.file' => '有効なファイルを選択してください',
            'zip_file.mimes' => 'ZIPファイルのみアップロードできます',
            'zip_file.max' => 'ファイルサイズは10MB以下にしてください',

        ];
    }
}
