<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'admin_name' => 'required|string|max:191',
            'admin_email' => 'required|string|email|max:191|unique:admin_users',
            'admin_password' => 'required|min:8|max:16',
            'role_id' => 'required|min:1|max:3',
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => '管理者の名前を入力してください。',
            'admin_email.required' => '管理者のメールアドレスを入力してください。',
            'admin_password.required' => '管理者のパスワードを入力してください',
            'admin_password.min' => '管理者のパスワードは8文字以上で入力してください。',
            'admin_password.max' => '管理者のパスワードは16文字以下で入力してください。',
        ];
    }
}
