// Persistent Audio Player
class PersistentPlayer {
    constructor() {
        this.audio = document.getElementById('audioElement');
        this.playPauseBtn = document.getElementById('playPauseBtn');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.currentTrackDisplay = document.getElementById('currentTrack');
        this.currentTimeDisplay = document.getElementById('currentTime');
        this.durationDisplay = document.getElementById('duration');
        this.progressBar = document.getElementById('progressBar');
        this.progress = document.getElementById('progress');

        this.songs = window.SONG_LIST || [];
        this.currentIndex = 0;

        this.init();
    }

    init() {
        // Restore player state from localStorage
        this.restoreState();

        // Event listeners
        this.playPauseBtn.addEventListener('click', () => this.togglePlayPause());
        this.prevBtn.addEventListener('click', () => this.previousTrack());
        this.nextBtn.addEventListener('click', () => this.nextTrack());

        this.audio.addEventListener('timeupdate', () => this.updateProgress());
        this.audio.addEventListener('loadedmetadata', () => this.updateDuration());
        this.audio.addEventListener('ended', () => this.nextTrack());

        this.progressBar.addEventListener('click', (e) => this.seek(e));

        // Save state periodically
        this.audio.addEventListener('timeupdate', () => this.saveState());
        this.audio.addEventListener('pause', () => this.saveState());
        this.audio.addEventListener('play', () => this.saveState());

        // Update UI
        this.updateTrackDisplay();
    }

    togglePlayPause() {
        if (this.audio.paused) {
            if (!this.audio.src) {
                this.loadTrack(0);
            }
            this.audio.play();
            this.playPauseBtn.textContent = '❚❚';
        } else {
            this.audio.pause();
            this.playPauseBtn.textContent = '▶';
        }
    }

    loadTrack(index) {
        if (index < 0 || index >= this.songs.length) return;

        this.currentIndex = index;
        const song = this.songs[index];
        this.audio.src = song.path;
        this.updateTrackDisplay();
    }

    previousTrack() {
        const newIndex = this.currentIndex > 0 ? this.currentIndex - 1 : this.songs.length - 1;
        this.loadTrack(newIndex);
        this.audio.play();
        this.playPauseBtn.textContent = '❚❚';
    }

    nextTrack() {
        const newIndex = this.currentIndex < this.songs.length - 1 ? this.currentIndex + 1 : 0;
        this.loadTrack(newIndex);
        this.audio.play();
        this.playPauseBtn.textContent = '❚❚';
    }

    updateProgress() {
        if (this.audio.duration) {
            const percentage = (this.audio.currentTime / this.audio.duration) * 100;
            this.progress.style.width = percentage + '%';
            this.currentTimeDisplay.textContent = this.formatTime(this.audio.currentTime);
        }
    }

    updateDuration() {
        this.durationDisplay.textContent = this.formatTime(this.audio.duration);
    }

    updateTrackDisplay() {
        if (this.songs.length > 0 && this.songs[this.currentIndex]) {
            this.currentTrackDisplay.textContent = this.songs[this.currentIndex].name;
        }
    }

    seek(e) {
        const rect = this.progressBar.getBoundingClientRect();
        const percentage = (e.clientX - rect.left) / rect.width;
        this.audio.currentTime = percentage * this.audio.duration;
    }

    formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    saveState() {
        const state = {
            currentIndex: this.currentIndex,
            currentTime: this.audio.currentTime,
            isPlaying: !this.audio.paused,
            src: this.audio.src
        };
        localStorage.setItem('playerState', JSON.stringify(state));
    }

    restoreState() {
        const savedState = localStorage.getItem('playerState');
        if (savedState) {
            try {
                const state = JSON.parse(savedState);
                if (state.src && this.songs.length > 0) {
                    this.currentIndex = state.currentIndex || 0;
                    this.loadTrack(this.currentIndex);
                    this.audio.currentTime = state.currentTime || 0;

                    if (state.isPlaying) {
                        // Small delay to ensure page is loaded
                        setTimeout(() => {
                            this.audio.play().catch(() => {
                                // Auto-play blocked by browser, that's okay
                                this.playPauseBtn.textContent = '▶';
                            });
                            this.playPauseBtn.textContent = '❚❚';
                        }, 100);
                    }
                }
            } catch (e) {
                console.log('Could not restore player state');
            }
        }
    }
}

// Initialize player when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new PersistentPlayer();
});
