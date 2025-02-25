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
            'csv_file' => 'required|file|mimes:csv,txt|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'csv_file.required' => 'CSVファイルをアップロードしてください。',
            'csv_file.file' => 'CSVファイル形式でアップロードしてください。',
            'csv_file.mimes' => 'CSVファイルのみアップロード可能です。',
            'csv_file.max' => 'CSVファイルは最大5MBまでです。',
        ];
    }
}
