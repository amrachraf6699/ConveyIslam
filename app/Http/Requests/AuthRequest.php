<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'حقل البريدالإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'email.exists' => 'البريد الإلكتروني غير موجود في قاعدة البيانات',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.string' => 'كلمة المرور يجب أن تكون نصاً',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف',
            'password.max' => 'كلمة المرور لا يمكن أن تتجاوز 255 حرفاً',
        ];
    }
}
