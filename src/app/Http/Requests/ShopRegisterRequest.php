<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRegisterRequest extends FormRequest
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
            'shop_name' => 'required|string|max:191',
            'area_id' => 'required|integer|exists:areas,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'summary' => 'required|string|min:20',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '店名を入力してください。',
            'shop_name.string' => '店名は文字列で入力してください。',
            'shop_name.max:191' => '店名は191文字以下で入力してください。',
            'area_id.required' => 'エリアを選択してください。',
            'area_id.integer' => 'エリアは数値で選択してください。',
            'area_id.exists' => '選択されたエリアは登録がありません。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'genre_id.integer' => 'ジャンルは数値で選択してください。',
            'genre_id.exists' => '選択されたジャンルは登録がありません。',
            'summary.required' => '店舗概要を入力してください。',
            'summary.string' => '店舗概要は文字列で入力してください。',
            'summary.min' => '店舗概要は20文字以上で入力してください。',
            'image.required' => '店舗イメージをアップロードしてください。',
            'image.file' => '店舗イメージのファイルを選択してください。',
            'image.image' => '店舗イメージは画像にしてください。',
            'image.mimes' => 'jpeg,png,jpg,gifのいずれかの形式としてください。',
            'image.max' => '2048KB以下のファイルにしてください。',
            'user_id.required' => '店舗管理者のIDを選択してください。',
            'user_id.integer' => '店舗管理者のIDは数値で入力してください。',
            'user_id.exists' => '入力された店舗管理者のIDは登録がありません。',
        ];
    }
}
