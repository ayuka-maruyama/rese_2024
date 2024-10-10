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
            'comment' => 'required|string|min:10'
        ];
    }

    public function messages()
    {
        return [
            'evaluation.required' => '評価を選択してください',
            'comment.required' => 'レビューを入力してください',
            'comment.string' => 'レビューは文字列で入力してください',
            'comment.min' => 'レビューは10文字以上入力してください',
            'shop_id.exists' => '選択された店舗が存在しません。',
        ];
    }
}
