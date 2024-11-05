<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shop_name' => 'string|max:191',
            'area_id' => 'integer|exists:areas,id',
            'genre_id' => 'integer|exists:genres,id',
            'summary' => 'string|min:20',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'shop_name.string' => '店名は文字列で入力してください。',
            'shop_name.max:191' => '店名は191文字以下で入力してください。',
            'area_id.exists' => '選択されたエリアは登録がありません。',
            'genre_id.exists' => '選択されたジャンルは登録がありません。',
            'summary.string' => '店舗概要は文字列で入力してください。',
            'summary.min' => '店舗概要は20文字以上で入力してください。',
            'image.file' => '店舗イメージのファイルを選択してください。',
            'image.image' => '店舗イメージは画像にしてください。',
            'image.mimes' => 'jpeg,png,jpg,gifのいずれかの形式としてください。',
            'image.max' => '2048KB以下のファイルにしてください。',
        ];
    }
}
