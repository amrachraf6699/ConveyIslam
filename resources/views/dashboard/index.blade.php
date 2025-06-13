@extends('dashboard.layouts.app')
@section('title', 'الصفحة الرئيسية')
@section('content')
    <div
        class="relative z-10 bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-islamic-gold border-opacity-20 mb-8">
        <div class="flex items-start space-x-4 space-x-reverse">
            <div class="bg-islamic-gold bg-opacity-20 p-4 rounded-full">
                <div class="crescent-icon text-islamic-gold text-2xl">🌙</div>
            </div>
            <div class="flex-1">
                <h2 class="text-xl md:text-2xl font-semibold text-white mb-4">بسم الله الرحمن الرحيم</h2>
                <blockquote class="text-islamic-light font-amiri text-lg md:text-xl leading-relaxed mb-4">
                    "وَمَن يَتَّقِ اللَّهَ يَجْعَل لَّهُ مَخْرَجًا وَيَرْزُقْهُ مِنْ حَيْثُ لَا يَحْتَسِبُ"
                </blockquote>
                <cite class="text-islamic-gold text-sm">سورة الطلاق، الآية 2-3</cite>
            </div>
        </div>
    </div>

    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
            class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-islamic-light opacity-80 text-sm">إجمالي اللغات</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($languages_count) }}</p>
                </div>
                <div class="bg-islamic-gold bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-islamic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-islamic-light opacity-80 text-sm">عدد المسؤولين</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($languages_count) }}</p>
                </div>
                <div class="bg-islamic-gold bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-islamic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection