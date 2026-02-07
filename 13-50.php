<?php
$currentPage = '13-50';
$currentSong = '13-50';
$songs = glob('assets/audio/*.mp3');
$songList = [];
foreach ($songs as $song) {
    $songName = pathinfo($song, PATHINFO_FILENAME);
    $songList[] = [
        'name' => $songName,
        'path' => $song,
        'page' => $songName . '.php'
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>13-50 - The Final Trajectory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="song-page">
    <?php include 'includes/player.php'; ?>

    <div class="song-page-header">
        <h1 class="site-title"><a href="index.php">The Final Trajectory</a></h1>
        <h2 class="song-title-header">13-50</h2>
    </div>

    <div class="masonry-container">
        <div class="masonry-item">
            <img src="assets/images/IMG_8228.jpeg" alt="13-50 visual 1">
        </div>

        <div class="masonry-item masonry-item-text">
            <div class="song-explanation">
                <h3>13-50</h3>
                <p>Recorded on degraded tape loops between 1999-2001, this piece captures the essence of memory decay. The title references a specific frequency modulation discovered during late-night transmission experiments.</p>
                <p>Layered synthesizers pass through analog filters, creating warm distortions that evoke childhood recollections filtered through decades. Each repetition degrades slightly, mimicking the way our memories fade and transform over time.</p>
                <p>Listen for the recurring melodic fragment at 2:13—a deliberate callback to our earlier work, buried beneath static and time.</p>
            </div>
        </div>

        <div class="masonry-item">
            <img src="assets/images/IMG_8229.jpeg" alt="13-50 visual 2">
        </div>

        <div class="masonry-item">
            <img src="assets/images/IMG_8231.jpeg" alt="13-50 visual 3">
        </div>

        <div class="masonry-item">
            <img src="assets/images/IMG_8232.jpeg" alt="13-50 visual 4">
        </div>

        <div class="masonry-item">
            <img src="assets/images/IMG_8234.jpeg" alt="13-50 visual 5">
        </div>
    </div>

    <footer class="song-footer">
        <p><a href="index.php">← Back to Home</a></p>
    </footer>

    <script src="player.js"></script>
</body>
</html>
