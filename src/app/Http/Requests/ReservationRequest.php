<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required',
            'number_gest' => 'required|integer|min:1|max:10',
        ];
    }

    // エラーメッセージのカスタマイズ（任意）
    public function messages()
    {
        return [
            'date.required' => '予約日を入力してください。',
            'time.required' => '時間を入力してください。',
            'number_gest.required' => '人数を入力してください。',
            'number_gest.integer' => '人数は数字で入力してください。',
            'shop_id.exists' => '選択された店舗が存在しません。',
        ];
    }
}
