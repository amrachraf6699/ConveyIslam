<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
            'english_name' => 'required|string|max:255',
            'native_name' => 'required|string|max:255',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sound' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
            'new_sounds' => 'nullable|array',
            'new_sounds.*.name' => 'required|string|max:255',
            'new_sounds.*.file' => 'required|file|mimes:mp3,wav,ogg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'english_name.required' => 'الاسم بالإنجليزية مطلوب',
            'native_name.required' => 'الاسم باللغة الأصلية مطلوب',
            'flag.image' => 'الصورة يجب أن تكون صورة',
            'flag.mimes' => 'الصورة يجب أن تكون من نوع jpeg, png, jpg, أو gif',
            'flag.max' => 'حجم الصورة يجب أن لا يتجاوز 5 ميجابايت',
            'sound.file' => 'الملف الصوتي يجب أن يكون ملفًا',
            'sound.mimes' => 'الملف الصوتي يجب أن يكون من نوع mp3, wav, أو ogg',
            'sound.max' => 'حجم الملف الصوتي يجب أن لا يتجاوز 10 ميجابايت',
            'new_sounds.*.name.required' => 'اسم الصوت الجديد مطلوب',
            'new_sounds.*.file.required' => 'ملف الصوت الجديد مطلوب',
        ];
    }
}
