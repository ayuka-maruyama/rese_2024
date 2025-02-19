<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'shop_id' => 'required|integer|exists:shops,id',
            'evaluation' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:400',
            'image_url' => 'required|file|image|mimes:jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.exists' => '選択された店舗が存在しません。',
            'evaluation.required' => '評価（★）を選択してください。',
            'evaluation.integer' => '評価（★）は数値で選択してください。',
            'evaluation.min' => '評価（★）は1以上で選択してください。',
            'evaluation.max' => '評価（★）は5以下で選択してください。',
            'comment.required' => '口コミを入力してください。',
            'comment.string' => '口コミは文字で入力してください。',
            'comment.min' => '口コミは10文字以上入力してください。',
            'comment.max' => '口コミは400文字以内で入力してください。',
            'image_url.required' => '画像を選択してください。',
            'image_url.file' => '画像ファイルを選択してください。',
            'image_url.image' => '画像ファイルを選択してください。',
            'image_url.mimes' => '画像ファイルはJPEGまたはPNG形式で選択してください。',
        ];
    }
}
