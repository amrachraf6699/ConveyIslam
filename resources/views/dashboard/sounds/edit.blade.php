@extends('dashboard.layouts.app')
@section('title', 'تحرير اللغة')
@section('content')
    <div class="min-h-screen p-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8 mt-3">
                <h1 class="text-4xl font-bold text-white mb-2">تحرير الصوت الإضافي</h1>
                <p class="text-green-200">قم بتحرير بيانات الصوت</p>
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

            <form action="" method="POST" enctype="multipart/form-data">
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
                        <h2 class="text-2xl font-bold text-white">معلومات الصوت الإضافي</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">

                                                <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">الاسم *</label>
                            <input type="text" name="name" value="{{ old('name', $sound->name) }}"
                                class="w-full px-6 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-green-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all"
                                placeholder="أدخل الاسم" value="{{ old('name', $sound->name) }}"
                                required>
                        </div>
                        <!-- Language Audio -->
                        <div class="space-y-4">
                            <label class="block text-white font-semibold text-lg">الملف الصوتي *</label>
                            <div class="drop-zone rounded-2xl p-8 text-center cursor-pointer relative overflow-hidden"
                                onclick="document.getElementById('audio').click()">
                                <input type="file" id="audio" name="file" class="hidden" accept="audio/*"
                                    onchange="handleFileSelect(this, 'audio-preview')">

                                <div id="audio-preview" class="space-y-4">
                                    @if($sound->file)
                                        <div class="file-preview rounded-xl p-4">
                                            <audio controls class="mb-2">
                                                <source src="{{ asset('storage/' . $sound->file) }}" type="audio/mpeg">
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
                    </div>
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
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .crescent-icon {
            transform: rotate(-45deg);
        }

        .drop-zone {
            border: 2px dashed rgba(212, 175, 55, 0.5);
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .drop-zone.dragover {
            border-color: #d4af37;
            background: rgba(212, 175, 55, 0.1);
            transform: scale(1.02);
        }

        .drop-zone.has-file {
            border-color: #d4af37;
            border-style: solid;
            background: rgba(212, 175, 55, 0.1);
        }

        /* Preview Styling */
        .file-preview {
            background: rgba(15, 59, 40, 0.3);
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        /* Audio Player Styling */
        audio {
            width: 100%;
            height: 40px;
            border-radius: 0.75rem;
            background: rgba(15, 59, 40, 0.5);
        }

        audio::-webkit-media-controls-panel {
            background-color: rgba(15, 59, 40, 0.8);
        }

        audio::-webkit-media-controls-play-button {
            background-color: #d4af37;
            border-radius: 50%;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out forwards;
        }

        /* Remove button styling */
        .remove-btn {
            position: absolute;
            top: -8px;
            left: -8px;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .remove-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: scale(1.1);
        }

        /* Sound input styling */
        .sound-input-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .sound-input-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@push('scripts')
    <script>
        let soundCounter = 0;

        document.getElementById('addSoundBtn').addEventListener('click', function () {
            soundCounter++;
            const soundHtml = `
                    <div class="sound-input-card fade-in" id="sound-${soundCounter}">
                        <div class="remove-btn" onclick="removeSound(${soundCounter})">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                        </div>

                        <div class="flex items-center mb-6">
                            <h3 class="text-xl font-bold text-white">الصوت #${soundCounter}</h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <label class="block text-white font-semibold">اسم الصوت *</label>
                                <input type="text" name="new_sounds[${soundCounter}][name]" 
                                       class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-islamic-gold focus:border-transparent transition-all" 
                                       placeholder="أدخل اسم الصوت" required>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-white font-semibold">الملف الصوتي *</label>
                                <div class="drop-zone rounded-xl p-6 text-center cursor-pointer" onclick="document.getElementById('sound_file_${soundCounter}').click()">
                                    <input type="file" id="sound_file_${soundCounter}" name="new_sounds[${soundCounter}][file]" class="hidden" accept="audio/*" onchange="handleFileSelect(this, 'sound_preview_${soundCounter}')" required>
                                    <div id="sound_preview_${soundCounter}">
                                        <i class="fas fa-music text-4xl text-purple-300 mb-3"></i>
                                        <p class="text-white font-medium">اسحب الملف الصوتي أو انقر</p>
                                        <p class="text-green-200 text-sm mt-1">MP3, WAV, OGG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            document.getElementById('soundsContainer').insertAdjacentHTML('beforeend', soundHtml);
            initializeDragAndDrop();
        });

        function removeSound(id) {
            const element = document.getElementById(`sound-${id}`);
            element.style.animation = 'fadeOut 0.3s ease-in-out forwards';
            setTimeout(() => element.remove(), 300);
        }

        function confirmDelete(soundId, soundName) {
            document.getElementById('soundNameToDelete').textContent = `"${soundName}"`;
            document.getElementById('deleteForm').action = `/dashboard/sounds/${soundId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        function handleFileSelect(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            const dropZone = input.closest('.drop-zone');

            if (file) {
                dropZone.classList.add('has-file');

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = `
                                <div class="file-preview rounded-xl p-4 inline-block">
                                    <img src="${e.target.result}" alt="Preview" class="max-w-24 max-h-16 rounded-lg">
                                    <p class="text-yellow-300 text-sm mt-2 font-medium">تم اختيار: ${file.name}</p>
                                </div>
                            `;
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('audio/')) {
                    preview.innerHTML = `
                            <div class="file-preview rounded-xl p-4">
                                <i class="fas fa-music text-4xl text-yellow-300 mb-2"></i>
                                <p class="text-yellow-300 text-sm font-medium">تم اختيار: ${file.name}</p>
                            </div>
                        `;
                }
            }
        }

        function initializeDragAndDrop() {
            const dropZones = document.querySelectorAll('.drop-zone');

            dropZones.forEach(zone => {
                zone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    zone.classList.add('dragover');
                });

                zone.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    zone.classList.remove('dragover');
                });

                zone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    zone.classList.remove('dragover');

                    const files = e.dataTransfer.files;
                    const input = zone.querySelector('input[type="file"]');
                    const previewId = input.getAttribute('onchange').match(/handleFileSelect\(this, '([^']+)'\)/)[1];

                    if (files.length > 0) {
                        input.files = files;
                        handleFileSelect(input, previewId);
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            initializeDragAndDrop();

            const style = document.createElement('style');
            style.textContent = `
                    @keyframes fadeOut {
                        from { opacity: 1; transform: translateY(0); }
                        to { opacity: 0; transform: translateY(-10px); }
                    }
                `;
            document.head.appendChild(style);
        });
    </script>
@endpush