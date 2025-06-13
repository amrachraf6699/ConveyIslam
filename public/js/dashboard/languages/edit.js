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