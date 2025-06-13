@extends('dashboard.layouts.app')
@section('title', 'إضافة مسؤول جديد')
@section('content')
    <div class="max-w-6xl mx-auto">
        <header class="relative z-10 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">إضافة مسؤول جديد</h1>
                    <p class="text-white opacity-80 italic">قم بملء النموذج أدناه لإضافة مسؤول جديد إلى النظام.</p>
                </div>
            </div>
        </header>

        @if($errors->any())
            <div class="bg-red-500 bg-opacity-80 text-red-900 p-4 rounded-lg mb-6">
                <h3 class="font-bold">خطأ في النموذج</h3>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="relative z-10">
            <form id="languageForm" action="{{ route('dashboard.admins.store') }}" method="POST" class="space-y-8"
                enctype="multipart/form-data">
                @csrf

                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-yellow-400 border-opacity-20">
                    <div class="flex items-center mb-6">
                        <div class="bg-yellow-400 bg-opacity-20 p-3 rounded-full ml-4">
                            <svg class="w-6 h-6 text-yellow-400 opacity-80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 18.879A6 6 0 0112 15a6 6 0 016.879 3.879M15 9a3 3 0 11-6 0 3 3 0 016 0zM21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">معلومات المسؤول</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <label for="englishName" class="block text-white font-medium mb-3">الاسم *</label>
                            <input type="text" id="englishName" name="name" required
                                class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                placeholder="الاسم" dir="rtl" value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="nativeName" class="block text-white font-medium mb-3">البريد الإلكتروني *</label>
                            <input type="email" id="nativeName" name="email" required
                                class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                placeholder="البريد الإلكتروني" dir="ltr" value="{{ old('email') }}">
                        </div>

                        <div class="space-y-4">
                            <label for="nativeName" class="block text-white text-lg font-semibold mb-2">كلمة السر</label>
                            <input type="text" id="nativeName" name="password"
                                class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                placeholder="أدخل كلمة السر" dir="rtl" value="{{ old('password') }}">
                            <p class="text-sm text-gray-300 mt-2 leading-relaxed">
                                يمكنك ترك هذا الحقل فارغًا لاستخدام كلمة المرور الافتراضية:
                                <span
                                    class="inline-block mt-1 px-3 py-1 border border-yellow-400/50 rounded-lg text-yellow-400 font-medium">
                                    <span class="font-bold">12345678</span> (يمكن تغييرها لاحقًا)
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 md:p-8 shadow-lg border border-yellow-400 border-opacity-20">
                    <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('dashboard.admins.index') }}"
                            class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl transition-colors border border-gray-500">
                            إلغاء
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold rounded-xl transition-colors">
                            حفظ المسؤول
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