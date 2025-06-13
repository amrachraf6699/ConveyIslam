@extends('dashboard.layouts.app')
@section('title', 'اللغات')
@section('content')
    <div class="islamic-pattern fixed inset-0 pointer-events-none opacity-30"></div>

    <!-- Header -->
    <header class="relative z-10 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">قائمة اللغات</h1>
                <p class="text-islamic-light opacity-80">عرض وإدارة جميع اللغات المتاحة</p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('dashboard.languages.create') }}"
                    class="bg-islamic-gold hover:bg-islamic-gold-hover text-islamic-dark-green font-bold py-2 px-6 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 shadow-lg flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    إضافة لغة
                </a>
            </div>
        </div>
    </header>

    <!-- Filters Section -->
    <div class="relative z-10 mb-6">
        <form method="GET" action="">
            <div
                class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-islamic-gold border-opacity-20">
                <div class="flex items-center mb-6">
                    <div class="bg-islamic-gold bg-opacity-20 p-3 rounded-full ml-4">
                        <svg class="w-5 h-5 text-islamic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">تصفية النتائج</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-islamic-light font-medium mb-2">بحث</label>
                        <div class="relative">
                            <input type="text" id="search" name="search"
                                class="p-3 w-full bg-white bg-opacity-10 border border-islamic-gold border-opacity-30 rounded-xl text-white placeholder-islamic-light placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 transition-all"
                                placeholder="ابحث عن لغة..." value="{{ request('search') }}">
                            <svg class="w-5 h-5 text-islamic-gold absolute left-3 top-1/2 transform -translate-y-1/2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div>
                        <label for="hasAudio" class="block text-islamic-light font-medium mb-2">الملفات الصوتية</label>
                        <select id="hasAudio" name="hasAudio"
                            class="px-3 py-2 w-full bg-white bg-opacity-10 border border-islamic-gold border-opacity-30 rounded-xl text-white placeholder-islamic-light placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 transition-all">
                            <option value="" class="text-islamic-gold bg-islamic-dark-green" selected>جميع اللغات</option>
                            <option value="yes" {{ request('hasAudio') == 'yes' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">يحتوي على ملف صوتي</option>
                            <option value="no" {{ request('hasAudio') == 'no' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">لا يحتوي على ملف صوتي
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="sortBy" class="block text-islamic-light font-medium mb-2">ترتيب حسب</label>
                        <select id="sortBy" name="sortBy"
                            class="px-3 py-2 w-full bg-white bg-opacity-10 border border-islamic-gold border-opacity-30 rounded-xl text-white placeholder-islamic-light placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 transition-all">
                            <option value="name_asc" {{ request('sortBy') == 'name_asc' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green" selected>الاسم (أ - ي)
                            </option>
                            <option value="name_desc" {{ request('sortBy') == 'name_desc' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">الاسم (ي - أ)</option>
                            <option value="date_desc" class="text-islamic-gold bg-islamic-dark-green">الأحدث</option>
                            <option value="date_asc" {{ request('sortBy') == 'date_asc' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">الأقدم</option>
                            <option value="sounds_desc" {{ request('sortBy') == 'sounds_desc' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">عدد الأصوات (الأكثر)
                            </option>
                            <option value="sounds_asc" {{ request('sortBy') == 'sounds_asc' ? 'selected' : '' }}
                                class="text-islamic-gold bg-islamic-dark-green">عدد الأصوات (الأقل)
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center justify-between mt-8 gap-4">
                        <div class="flex gap-2">
                            <a id="clearFilters"
                                class="text-islamic-light border border-islamic-gold border-opacity-30 hover:bg-islamic-gold hover:bg-opacity-10 px-4 py-2 rounded-lg transition-colors">
                                مسح الفلاتر
                            </a>
                            <button type="submit"
                                class="bg-islamic-gold hover:bg-islamic-gold-hover text-islamic-dark-green font-bold px-4 py-2 rounded-lg transition-colors">
                                تطبيق
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="relative z-10 mb-6">
        <div
            class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
            <div class="table-container">
                <table class="islamic-table">
                    <thead>
                        <tr>
                            <th class="w-16 text-center">#</th>
                            <th class="w-20 text-center">العلم</th>
                            <th>الاسم بالإنجليزية</th>
                            <th>الاسم الأصلي</th>
                            <th>الملف الصوتي</th>
                            <th class="text-center">عدد الأصوات</th>
                            <th class="w-24 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($languages as $language)
                            <tr>
                                <td class="text-center">{{ $language->id }}
                                <td class="text-center">
                                    <img src="{{ $language->flag_url }}" alt="Saudi Arabia"
                                        class="flag-image inline-block">
                                </td>
                                <td>{{ $language->english_name }}</td>
                                <td>{{ $language->native_name }}</td>
                                <td>
                                    <div class="custom-audio-player"
                                        data-audio="{{ $language->sound_url }}">
                                        <div class="play-button">
                                            <svg class="w-4 h-4 text-islamic-dark-green" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="progress-container">
                                            <div class="progress-bar"></div>
                                        </div>
                                        <div class="time-display">0:00</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $language->sounds_count > 0 ? "badge-gold" : "badge-danger" }}">{{ $language->sounds_count }}</span>
                                </td>
                                <td>
                                    <div class="flex justify-center space-x-2 space-x-reverse">
                                        <button class="action-button edit" title="تعديل">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button class="action-button delete" title="حذف">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-islamic-light">
                                    لا توجد لغات متاحة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <div class="flex flex-wrap items-center justify-between mt-6 gap-4">
                <div class="text-islamic-light text-sm">
                    عرض <span class="font-bold">1</span> إلى <span class="font-bold">2</span> من <span
                        class="font-bold">24</span> لغة
                </div>

                <div class="flex items-center space-x-1 space-x-reverse">
                    <button
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors"
                        disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <button
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-dark-green bg-islamic-gold font-bold">1</button>
                    <button
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">2</button>
                    <button
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">3</button>
                    <span class="text-islamic-light px-2">...</span>
                    <button
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/languages/index.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/languages/index.js') }}"></script>
@endpush