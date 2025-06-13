<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoundRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الصوت مطلوب',
            'file.file' => 'الملف يجب أن يكون ملفًا',
            'file.mimes' => 'الملف يجب أن يكون من نوع mp3, wav, أو ogg',
            'file.max' => 'حجم الملف يجب أن لا يتجاوز 2 ميجابايت',
        ];
    }
}
