<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassowrdRequest extends FormRequest
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
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'حقل كلمة المرور الحالية مطلوب.',
            'new_password.required' => 'حقل كلمة المرور الجديدة مطلوب.',
            'new_password.min' => 'كلمة المرور الجديدة يجب أن تكون على الأقل 8 أحرف.',
            'new_password.confirmed' => 'تأكيد كلمة المرور الجديدة غير متطابق.',
        ];
    }
}
