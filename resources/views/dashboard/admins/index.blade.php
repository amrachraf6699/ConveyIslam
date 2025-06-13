@extends('dashboard.layouts.app')
@section('title', 'المسؤولين')
@section('content')
    <div class="islamic-pattern fixed inset-0 pointer-events-none opacity-30"></div>

    <header class="relative z-10 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">قائمة المسؤولين</h1>
                <p class="text-islamic-light opacity-80">عرض وإدارة جميع المسؤولين في النظام</p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('dashboard.admins.create') }}"
                    class="bg-islamic-gold hover:bg-islamic-gold-hover text-islamic-dark-green font-bold py-2 px-6 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:ring-opacity-50 shadow-lg flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    إضافة مسؤول
                </a>
            </div>
        </div>
    </header>

    <div class="relative z-10 mb-6">
        <div
            class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-islamic-gold border-opacity-20">
            <div class="table-container">
                <table class="islamic-table">
                    <thead>
                        <tr>
                            <th class="w-16 text-center">#</th>
                            <th class="text-center">الإسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>عدد اللغات المضافة</th>
                            <th>تاريخ الإنشاء</th>
                            <th class="w-24 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            <tr>
                                <td class="text-center">{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $admin->languages_count > 0 ? "badge-gold" : "badge-danger" }}">{{ $admin->languages_count }}</span>
                                </td>
                                <td>{{ $admin->created_at->format('Y-m-d') }} ({{ $admin->created_at->diffForHumans() }})</td>
                                <td>
                                    <div class="flex justify-center space-x-2 space-x-reverse">
                                        <a href="{{ route('dashboard.admins.edit' , $admin) }}" class="action-button edit" title="تعديل">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button class="action-button delete" 
                                                title="حذف"
                                                data-language-id="{{ $admin->id }}"
                                                data-language-name="{{ $admin->name }}"
                                                onclick="showDeleteModal({{ $admin->id }}, '{{ $admin->name }}')">
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
                                    لا يوجد مسؤولين متاحة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($admins->hasPages())
                <div class="flex flex-wrap items-center justify-between mt-6 gap-4">
                    <div class="text-islamic-light text-sm">
                        عرض <span class="font-bold">{{ $admins->firstItem() }}</span> إلى <span class="font-bold">{{ $admins->lastItem() }}</span> من <span class="font-bold">{{ $admins->total() }}</span> مسؤول
                    </div>

                    <div class="flex items-center space-x-1 space-x-reverse">
                        @if ($admins->onFirstPage())
                            <span class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 border border-gray-600 border-opacity-20 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $admins->previousPageUrl() }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                        @endif

                        @foreach ($admins->getUrlRange(1, $admins->lastPage()) as $page => $url)
                            @if ($page == $admins->currentPage())
                                <span class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-dark-green bg-islamic-gold font-bold">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($admins->hasMorePages())
                            <a href="{{ $admins->nextPageUrl() }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-islamic-light border border-islamic-gold border-opacity-20 hover:bg-islamic-gold hover:bg-opacity-10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <span class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 border border-gray-600 border-opacity-20 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8 max-w-md w-full mx-4 border border-islamic-gold border-opacity-20">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 bg-opacity-20 mb-4">
                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                
                <h3 class="text-lg font-bold text-white mb-2">تأكيد الحذف</h3>
                
                <p class="text-islamic-light mb-6">
                    هل أنت متأكد من حذف المسؤول "<span id="languageNameToDelete" class="font-bold text-islamic-gold"></span>"؟
                    <br>
                    <span class="text-sm text-red-300">لا يمكن التراجع عن هذا الإجراء.</span>
                </p>
                
                <div class="flex justify-center space-x-4 space-x-reverse">
                    <button onclick="hideDeleteModal()" 
                            class="px-6 py-2 bg-gray-500 bg-opacity-20 text-islamic-light rounded-lg hover:bg-opacity-30 transition-colors">
                        إلغاء
                    </button>
                    <button onclick="confirmDelete()" 
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        حذف
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/languages/index.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/languages/index.js') }}"></script>
    <script>
        let languageIdToDelete = null;
        
        function showDeleteModal(languageId, languageName) {
            languageIdToDelete = languageId;
            document.getElementById('languageNameToDelete').textContent = languageName;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
            languageIdToDelete = null;
        }
        
        function confirmDelete() {
            if (languageIdToDelete) {
                const form = document.getElementById('deleteForm');
                form.action = `/dashboard/admins/${languageIdToDelete}`;
                form.submit();
            }
        }
        
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDeleteModal();
            }
        });
        
        document.getElementById('clearFilters').addEventListener('click', function(e) {
            e.preventDefault();
            
            document.getElementById('search').value = '';
            document.getElementById('hasAudio').value = '';
            document.getElementById('sortBy').value = 'name_asc';
            
            window.location.href = '{{ route("dashboard.admins.index") }}';
        });
    </script>
@endpush