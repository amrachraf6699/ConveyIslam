@extends('dashboard.layouts.app')
@section('title', 'تحرير اللغة')
@section('content')
    <div class="min-h-screen p-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8 mt-3">
                <h1 class="text-4xl font-bold text-white mb-2">تحرير اللغة</h1>
                <p class="text-green-200">قم بتحرير بيانات اللغة والأصوات المرتبطة بها</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-500/20 backdrop-blur-sm border border-red-400/30 rounded-2xl p-6 fade-in">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-400 text-2xl ml-3"></i>
                        <h3 class="text-xl font-bold text-red-300">خطأ في النموذج</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach($errors->all() as $error)
                            <li class="text-red-200 flex items-center">
                                <i class="fas fa-circle text-red-400 text-xs ml-2"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.languages.update', $language->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 mb-8 shadow-2xl fade-in">
                    <div class="flex items-center mb-6">
                        <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                            <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">معلومات اللغة</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">علم اللغة *</label>
                            <div class="drop-zone rounded-2xl p-8 text-center cursor-pointer relative overflow-hidden"
                                onclick="document.getElementById('flag').click()">
                                <input type="file" id="flag" name="flag" class="hidden" accept="image/*"
                                    onchange="handleFileSelect(this, 'flag-preview')">

                                <div id="flag-preview" class="space-y-4">
                                    @if($language->flag)
                                        <div class="file-preview rounded-xl p-4 inline-block">
                                            <img src="{{ asset('storage/' . $language->flag) }}" alt="Current Flag"
                                                class="max-w-24 max-h-16 rounded-lg">
                                            <p class="text-yellow-300 text-sm mt-2 font-medium">العلم الحالي</p>
                                        </div>
                                    @endif
                                    <div>
                                        <i class="fas fa-flag text-6xl text-yellow-300 mb-4"></i>
                                        <p class="text-white text-lg font-medium">اسحب صورة العلم هنا أو انقر للاختيار</p>
                                        <p class="text-green-200 text-sm mt-2">يدعم: JPG, PNG, GIF (حد أقصى 5MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Language Audio -->
                        <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">صوت اللغة *</label>
                            <div class="drop-zone rounded-2xl p-8 text-center cursor-pointer relative overflow-hidden"
                                onclick="document.getElementById('audio').click()">
                                <input type="file" id="audio" name="sound" class="hidden" accept="audio/*"
                                    onchange="handleFileSelect(this, 'audio-preview')">

                                <div id="audio-preview" class="space-y-4">
                                    @if($language->sound)
                                        <div class="file-preview rounded-xl p-4">
                                            <audio controls class="mb-2">
                                                <source src="{{ asset('storage/' . $language->sound) }}" type="audio/mpeg">
                                            </audio>
                                            <p class="text-yellow-300 text-sm font-medium">الملف الصوتي الحالي</p>
                                        </div>
                                    @endif
                                    <div>
                                        <i class="fas fa-music text-6xl text-yellow-300 mb-4"></i>
                                        <p class="text-white text-lg font-medium">اسحب الملف الصوتي هنا أو انقر للاختيار</p>
                                        <p class="text-green-200 text-sm mt-2">يدعم: MP3, WAV, OGG (حد أقصى 10MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- English Name -->
                        <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">الاسم بالإنجليزية *</label>
                            <input type="text" name="english_name"
                                value="{{ old('english_name', $language->english_name) }}"
                                class="w-full px-6 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all"
                                placeholder="أدخل الاسم بالإنجليزية"
                                value="{{ old('english_name', $language->english_name) }}" required>
                        </div>

                        <!-- Native Name -->
                        <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">الاسم باللغة الأم *</label>
                            <input type="text" name="native_name" value="{{ old('native_name', $language->native_name) }}"
                                class="w-full px-6 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all"
                                placeholder="أدخل الاسم باللغة الأم" required>
                        </div>
                    </div>
                </div>

                <!-- Existing Sounds -->
                @if($language->sounds && $language->sounds->count() > 0)
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 mb-8 shadow-2xl fade-in">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                                    <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white">الأصوات الإضافية الموجودة</h2>
                            </div>
                            <span class="bg-blue-500/20 text-blue-300 px-4 py-2 rounded-full text-sm font-medium">
                                {{ $language->sounds->count() }} صوت
                            </span>
                        </div>

                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($language->sounds as $sound)
                                <div
                                    class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all hover:scale-105 hover:shadow-lg">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-white font-semibold text-lg truncate">{{ $sound->name }}</h3>
                                        <div class="flex space-x-2 gap-1">
                                            <a href="{{ route('dashboard.sounds.edit', $sound->id) }}"
                                                class="w-8 h-8 bg-yellow-500/20 hover:bg-yellow-500/30 border border-yellow-400/30 rounded-lg flex items-center justify-center text-yellow-400 hover:text-yellow-300 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <button type="button" onclick="confirmDelete({{ $sound->id }}, '{{ $sound->name }}')"
                                                class="w-8 h-8 bg-red-500/20 hover:bg-red-500/30 border border-red-400/30 rounded-lg flex items-center justify-center text-red-400 hover:text-red-300 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <audio controls class="w-full">
                                            <source src="{{ asset('storage/' . $sound->file) }}" type="audio/mpeg">
                                        </audio>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 mb-8 shadow-2xl fade-in">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                                <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">إضافة أصوات إضافية جديدة</h2>
                        </div>
                        <button type="button" id="addSoundBtn"
                            class="bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold py-3 px-6 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 shadow-lg flex items-center">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            إضافة صوت
                        </button>
                    </div>

                    <div id="soundsContainer" class="space-y-6">
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('dashboard.languages.index') }}"
                        class="bg-gray-500/20 hover:bg-gray-500/30 backdrop-blur-sm border border-gray-400/30 text-gray-300 hover:text-white px-8 py-4 rounded-xl font-medium transition-all hover:scale-105">
                        <i class="fas fa-arrow-left ml-2"></i>
                        إلغاء
                    </a>
                    <button type="submit"
                        class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-4 rounded-xl font-medium transition-all hover:scale-105 shadow-lg">
                        <i class="fas fa-save ml-2"></i>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div
            class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl relative fade-in">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">تأكيد الحذف</h3>
                <p class="text-green-200 mb-2">هل أنت متأكد من أنك تريد حذف الصوت</p>
                <p class="text-yellow-300 font-semibold mb-6" id="soundNameToDelete"></p>
                <div class="bg-red-500/10 border border-red-400/20 rounded-xl p-4 mb-6">
                    <p class="text-red-300 text-sm">
                        <i class="fas fa-info-circle ml-2"></i>
                        هذا الإجراء لا يمكن التراجع عنه!
                    </p>
                </div>
                <div class="flex space-x-4">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 bg-gray-500/20 hover:bg-gray-500/30 text-gray-300 hover:text-white py-3 px-6 rounded-xl font-medium transition-all">
                        إلغاء
                    </button>
                    <form id="deleteForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 px-6 rounded-xl font-medium transition-all hover:scale-105">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/languages/edit.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/languages/edit.js') }}"></script>
@endpush