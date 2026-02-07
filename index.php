<?php
$currentPage = 'home';
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
    <title>The Final Trajectory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/player.php'; ?>

    <div class="container">
        <header>
            <h1 class="site-title">The Final Trajectory</h1>
        </header>

        <main class="home-content">
            <div class="home-intro">
                <p class="tagline">Electronic music from the edges of memory</p>
            </div>

            <nav class="song-list">
                <h2>Tracks</h2>
                <ul>
                    <?php foreach ($songList as $song): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($song['page']); ?>" class="song-link">
                                <?php echo htmlspecialchars($song['name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> The Final Trajectory</p>
        </footer>
    </div>

    <script src="player.js"></script>
</body>
</html>
