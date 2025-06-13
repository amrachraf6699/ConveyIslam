document.addEventListener('DOMContentLoaded', function () {
    let soundCounter = 1;

    // معالج رفع علم اللغة
    setupFileUpload('flagDropZone', 'flagInput', 'flagUploadArea', 'flagPreview', 'image');

    // معالج رفع صوت اللغة
    setupFileUpload('languageSoundDropZone', 'languageSoundInput', 'languageSoundUploadArea', 'languageSoundPreview', 'audio');

    // معالج إضافة صوت جديد
    document.getElementById('addSoundBtn').addEventListener('click', function () {
        soundCounter++;
        const soundsContainer = document.getElementById('soundsContainer');
        const newSoundHTML = createSoundItemHTML(soundCounter);
        soundsContainer.insertAdjacentHTML('beforeend', newSoundHTML);

        // إعداد معالج الرفع للصوت الجديد
        const newSoundItem = soundsContainer.lastElementChild;
        const dropZone = newSoundItem.querySelector('.sound-drop-zone');
        const fileInput = newSoundItem.querySelector('.sound-file-input');
        const uploadArea = newSoundItem.querySelector('.sound-upload-area');
        const preview = newSoundItem.querySelector('.sound-preview');

        setupSoundFileUpload(dropZone, fileInput, uploadArea, preview);

        // إظهار زر الحذف للأصوات الإضافية
        if (soundCounter > 1) {
            newSoundItem.querySelector('.remove-sound-btn').classList.remove('hidden');
        }

        updateRemoveButtons();
    });

    // معالج حذف الأصوات
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-sound-btn')) {
            e.target.closest('.sound-item').remove();
            updateSoundNumbers();
            updateRemoveButtons();
        }
    });

    // إعداد معالج رفع الملفات للصوت الأول
    const firstSoundDropZone = document.querySelector('.sound-drop-zone');
    const firstSoundInput = document.querySelector('.sound-file-input');
    const firstSoundUploadArea = document.querySelector('.sound-upload-area');
    const firstSoundPreview = document.querySelector('.sound-preview');

    setupSoundFileUpload(firstSoundDropZone, firstSoundInput, firstSoundUploadArea, firstSoundPreview);

    function setupFileUpload(dropZoneId, inputId, uploadAreaId, previewId, fileType) {
        const dropZone = document.getElementById(dropZoneId);
        const fileInput = document.getElementById(inputId);
        const uploadArea = document.getElementById(uploadAreaId);
        const preview = document.getElementById(previewId);

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-opacity-20');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-opacity-20');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-opacity-20');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileUpload(files[0], uploadArea, preview, fileType);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0], uploadArea, preview, fileType);
            }
        });
    }

    function setupSoundFileUpload(dropZone, fileInput, uploadArea, preview) {
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-opacity-20');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-opacity-20');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-opacity-20');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileUpload(files[0], uploadArea, preview, 'audio');
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0], uploadArea, preview, 'audio');
            }
        });
    }

    function handleFileUpload(file, uploadArea, preview, fileType) {
        if ((fileType === 'image' && file.type.startsWith('image/')) ||
            (fileType === 'audio' && file.type.startsWith('audio/'))) {

            uploadArea.classList.add('hidden');
            preview.classList.remove('hidden');

            if (fileType === 'image') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `
                                <div class="relative">
                                    <img src="${e.target.result}" alt="Flag Preview" class="max-w-full h-32 object-contain mx-auto rounded-lg">
                                    <p class="text-green-400 text-sm mt-2 text-center">${file.name}</p>
                                </div>
                            `;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = `
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white text-sm">${file.name}</span>
                            </div>
                        `;
            }
        } else {
            alert('من فضلك اختر ملف صالح');
        }
    }

    function createSoundItemHTML(number) {
        return `
                    <div class="sound-item fade-in bg-white bg-opacity-5 rounded-xl p-6 border border-yellow-400 border-opacity-10 relative">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-yellow-400 opacity-80">الصوت #<span class="sound-number">${number}</span></h3>
                            <button type="button" class="remove-sound-btn text-red-300 hover:text-red-200 transition-colors p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-white font-medium mb-3">اسم الصوت *</label>
                                <input type="text" name="sound_names[]" required 
                                    class="p-3 rounded-xl bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                                    placeholder="أدخل اسم الصوت">
                            </div>
                            
                            <div>
                                <label class="block text-white font-medium mb-3">الملف الصوتي *</label>
                                <div class="drop-zone rounded-xl p-3 text-center cursor-pointer sound-drop-zone bg-white bg-opacity-10 border border-yellow-400 border-opacity-20 hover:bg-opacity-15 transition-all">
                                    <input type="file" name="sound_files[]" accept="audio/*" class="hidden sound-file-input" required>
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
                `;
    }

    function updateSoundNumbers() {
        const soundItems = document.querySelectorAll('.sound-item');
        soundItems.forEach((item, index) => {
            item.querySelector('.sound-number').textContent = index + 1;
        });
        soundCounter = soundItems.length;
    }

    function updateRemoveButtons() {
        const soundItems = document.querySelectorAll('.sound-item');
        const removeButtons = document.querySelectorAll('.remove-sound-btn');

        if (soundItems.length <= 1) {
            removeButtons.forEach(btn => btn.classList.add('hidden'));
        } else {
            removeButtons.forEach(btn => btn.classList.remove('hidden'));
        }
    }
});