<?php
// Get all songs
$allSongs = glob('assets/audio/*.mp3');
$songsJson = json_encode(array_map(function($song) {
    return [
        'name' => pathinfo($song, PATHINFO_FILENAME),
        'path' => $song
    ];
}, $allSongs));
?>
<div id="audio-player" class="audio-player">
    <div class="player-controls">
        <button id="prevBtn" class="control-btn" title="Previous">‹</button>
        <button id="playPauseBtn" class="control-btn play-pause" title="Play/Pause">▶</button>
        <button id="nextBtn" class="control-btn" title="Next">›</button>
    </div>

    <div class="player-info">
        <span id="currentTrack" class="track-name">Select a track</span>
        <div class="time-display">
            <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
        </div>
    </div>

    <div class="progress-container">
        <div id="progressBar" class="progress-bar">
            <div id="progress" class="progress"></div>
        </div>
    </div>

    <audio id="audioElement"></audio>
</div>

<script>
    // Pass PHP song list to JavaScript
    window.SONG_LIST = <?php echo $songsJson; ?>;
</script>
