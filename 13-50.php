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
<body>
    <?php include 'includes/player.php'; ?>

    <div class="container">
        <header>
            <h1 class="site-title"><a href="index.php">The Final Trajectory</a></h1>
        </header>

        <main class="song-content">
            <div class="song-header">
                <h2 class="song-title">13-50</h2>
            </div>

            <div class="song-description">
                <p>A journey through analog memories and forgotten frequencies.</p>
            </div>

            <nav class="song-navigation">
                <h3>Other Tracks</h3>
                <ul>
                    <?php foreach ($songList as $song): ?>
                        <?php if ($song['name'] !== $currentSong): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($song['page']); ?>" class="song-link">
                                    <?php echo htmlspecialchars($song['name']); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </main>

        <footer>
            <p><a href="index.php">Back to Home</a></p>
        </footer>
    </div>

    <script src="player.js"></script>
</body>
</html>
