
document.addEventListener('DOMContentLoaded', function () {
    const audioPlayers = document.querySelectorAll('.custom-audio-player');

    audioPlayers.forEach(player => {
        const audioUrl = player.dataset.audio;
        const audio = new Audio(audioUrl);
        const playButton = player.querySelector('.play-button');
        const progressBar = player.querySelector('.progress-bar');
        const timeDisplay = player.querySelector('.time-display');

        // Play/Pause functionality
        playButton.addEventListener('click', function () {
            if (audio.paused) {
                // Pause all other audio players first
                document.querySelectorAll('.custom-audio-player').forEach(otherPlayer => {
                    if (otherPlayer !== player) {
                        const otherAudio = new Audio(otherPlayer.dataset.audio);
                        otherAudio.pause();
                        otherPlayer.querySelector('.play-button').innerHTML = `
                                    <svg class="w-4 h-4 text-islamic-dark-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                `;
                        otherPlayer.querySelector('.progress-bar').style.width = '0%';
                        otherPlayer.querySelector('.time-display').textContent = '0:00';
                    }
                });

                audio.play();
                this.innerHTML = `
                            <svg class="w-4 h-4 text-islamic-dark-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        `;
            } else {
                audio.pause();
                this.innerHTML = `
                            <svg class="w-4 h-4 text-islamic-dark-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        `;
            }
        });

        // Update progress bar and time display
        audio.addEventListener('timeupdate', function () {
            const percent = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = percent + '%';

            // Format time display
            const minutes = Math.floor(audio.currentTime / 60);
            const seconds = Math.floor(audio.currentTime % 60).toString().padStart(2, '0');
            timeDisplay.textContent = `${minutes}:${seconds}`;
        });

        // Reset when audio ends
        audio.addEventListener('ended', function () {
            playButton.innerHTML = `
                        <svg class="w-4 h-4 text-islamic-dark-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    `;
            progressBar.style.width = '0%';
            timeDisplay.textContent = '0:00';
        });

        // Click on progress bar to seek
        player.querySelector('.progress-container').addEventListener('click', function (e) {
            const percent = e.offsetX / this.offsetWidth;
            audio.currentTime = percent * audio.duration;
        });
    });

    // Filter functionality
    document.getElementById('clearFilters').addEventListener('click', function () {
        document.getElementById('search').value = '';
        document.getElementById('region').value = '';
        document.getElementById('hasAudio').value = '';
        document.getElementById('sortBy').value = 'name_asc';
    });

});