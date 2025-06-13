<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
        return
        [
            'flag' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'english_name' => 'required|string|max:255',
            'native_name' => 'required|string|max:255',
            'sound' => 'required|file|mimes:mp3,wav,ogg|max:10240',
            'sound_names' => 'required|array|min:1',
            'sound_names.*' => 'required|string|max:255',
            'sound_files' => 'required|array|min:1',
            'sound_files.*' => 'required|file|mimes:mp3,wav,ogg|max:10240',
        ];
    }

    public function messages(): array
    {
        return
        [
            'flag.required' => 'علم اللغة مطلوب',
            'flag.image' => 'يجب أن يكون علم اللغة صورة',
            'flag.mimes' => 'صيغة علم اللغة غير مدعومة',
            'flag.max' => 'حجم علم اللغة يجب أن يكون أقل من 5 ميجابايت',
            'english_name.required' => 'الاسم بالإنجليزية مطلوب',
            'native_name.required' => 'الاسم باللغة الأم مطلوب',
            'sound.required' => 'صوت اللغة مطلوب',
            'sound.mimes' => 'صيغة صوت اللغة غير مدعومة',
            'sound.max' => 'حجم صوت اللغة يجب أن يكون أقل من 10 ميجابايت',
            'sound_names.required' => 'أسماء الأصوات مطلوبة',
            'sound_names.min' => 'يجب إضافة صوت واحد على الأقل',
            'sound_names.*.required' => 'اسم الصوت مطلوب',
            'sound_files.required' => 'ملفات الأصوات مطلوبة',
            'sound_files.min' => 'يجب إضافة ملف صوتي واحد على الأقل',
            'sound_files.*.required' => 'ملف الصوت مطلوب',
            'sound_files.*.mimes' => 'صيغة ملف الصوت غير مدعومة',
            'sound_files.*.max' => 'حجم ملف الصوت يجب أن يكون أقل من 10 ميجابايت',
        ];
    }
}
