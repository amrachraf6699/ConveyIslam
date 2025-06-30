@extends('dashboard.layouts.app')
@section('title', 'إضافة لغة جديدة')
@section('content')
    <div class="max-w-6xl mx-auto">
            <header class="relative z-10 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">إضافة لغة جديدة</h1>
                        <p class="text-white opacity-80 italic">إضافة لغة جديدة مع الأصوات المرتبطة بها</p>
                    </div>
                </div>
            </header>

            @if($errors->any())
                <div class="bg-red-500 bg-opacity-10 text-red-900 p-4 rounded-lg mb-6">
                    <h3 class="font-bold">خطأ في النموذج</h3>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="relative z-10">
                <form id="languageForm" action="{{ route('dashboard.languages.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                    @csrf

                    <!-- معلومات اللغة -->
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-yellow-400 border-opacity-20">
                        <div class="flex items-center mb-6">
                            <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                                <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">معلومات اللغة</h2>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- علم اللغة -->
                            <div class="lg:col-span-2">
                                <label class="block text-white font-medium mb-3">علم اللغة *</label>
                                <div class="drop-zone rounded-xl p-6 text-center cursor-pointer bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 hover:bg-opacity-15 transition-all" id="flagDropZone">
                                    <input type="file" id="flagInput" name="flag" accept="image/*" class="hidden" required>
                                    <div id="flagUploadArea">
                                        <svg class="w-12 h-12 text-yellow-400 opacity-80 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-white text-lg mb-2">اسحب صورة العلم هنا أو انقر للاختيار</p>
                                        <p class="text-white opacity-60 text-sm">يدعم: JPG, PNG, GIF (حد أقصى 5MB)</p>
                                    </div>
                                    <div id="flagPreview" class="hidden"></div>
                                </div>
                            </div>

                            <!-- الاسم بالإنجليزية -->
                            <div>
                                <label for="englishName" class="block text-white font-medium mb-3">الاسم بالإنجليزية *</label>
                                <input type="text" id="englishName" name="english_name" required 
                                    class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                    placeholder="الاسم باللغة الإنجليزية" dir="ltr">
                            </div>

                            <!-- الاسم باللغة الأم -->
                            <div>
                                <label for="nativeName" class="block text-white font-medium mb-3">الاسم باللغة الأم *</label>
                                <input type="text" id="nativeName" name="native_name" required 
                                    class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                    placeholder="الاسم باللغة الأم" dir="ltr">
                            </div>

                            <!-- صوت اللغة -->
                            <div class="lg:col-span-2">
                                <label class="block text-white font-medium mb-3">صوت اللغة *</label>
                                <div class="drop-zone rounded-xl p-6 text-center cursor-pointer bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 hover:bg-opacity-15 transition-all" id="languageSoundDropZone">
                                    <input type="file" id="languageSoundInput" name="sound" accept="audio/*" class="hidden" required>
                                    <div id="languageSoundUploadArea">
                                        <svg class="w-12 h-12 text-yellow-400 opacity-80 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                        </svg>
                                        <p class="text-white text-lg mb-2">اسحب الملف الصوتي هنا أو انقر للاختيار</p>
                                        <p class="text-white opacity-60 text-sm">يدعم: MP3, WAV, OGG (حد أقصى 10MB)</p>
                                    </div>
                                    <div id="languageSoundPreview" class="hidden"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الأصوات -->
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-yellow-400 border-opacity-20">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                                    <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white">الأصوات</h2>
                            </div>
                            <button type="button" id="addSoundBtn" class="bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold py-3 px-6 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 shadow-lg flex items-center">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                إضافة صوت
                            </button>
                        </div>

                        <div id="soundsContainer" class="space-y-6">
                            <!-- صوت واحد افتراضي -->
                            <div class="sound-item fade-in bg-white bg-opacity-5 rounded-xl p-6 border border-yellow-400 border-opacity-10 relative">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-bold text-yellow-400 opacity-80">الصوت #<span class="sound-number">1</span></h3>
                                    <button type="button" class="remove-sound-btn text-red-300 hover:text-red-200 transition-colors p-2 hidden">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-white font-medium mb-3">اسم الصوت</label>
                                        <input type="text" name="sound_names[]" 
                                            class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                            placeholder="أدخل اسم الصوت">
                                    </div>

                                    <div>
                                        <label class="block text-white font-medium mb-3">الملف الصوتي</label>
                                        <div class="drop-zone rounded-xl p-3 text-center cursor-pointer sound-drop-zone bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 hover:bg-opacity-15 transition-all">
                                            <input type="file" name="sound_files[]" accept="audio/*" class="hidden sound-file-input">
                                            <div class="sound-upload-area">
                                                <svg class="w-6 h-6 text-yellow-400 opacity-80 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                                </svg>
                                                <p class="text-white text-sm mb-1">اسحب الملف الصوتي أو انقر</p>
                                                <p class="text-white opacity-60 text-xs">MP3, WAV, OGG</p>
                                            </div>
                                            <div class="sound-preview hidden"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- أزرار الحفظ -->
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-yellow-400 border-opacity-20">
                        <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('dashboard.languages.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl transition-colors border border-gray-500">
                                إلغاء
                            </a>
                            <button type="submit" class="px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold rounded-xl transition-colors">
                                حفظ اللغة
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/languages/create.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/languages/create.js') }}"></script>
@endpush