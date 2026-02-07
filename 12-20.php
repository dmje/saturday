<?php
$currentPage = '12-20';
$currentSong = '12-20';
$image_path = 'assets/images/' . $currentSong . '/';

// Get all songs for player
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

// Get all media files (images and videos) from the song's folder
$imageExtensions = '{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}';
$videoExtensions = '{mp4,webm,mov,MP4,WEBM,MOV}';

$images = glob($image_path . '*.' . $imageExtensions, GLOB_BRACE);
$videos = glob($image_path . '*.' . $videoExtensions, GLOB_BRACE);

$mediaFiles = array_merge($images ?: [], $videos ?: []);
sort($mediaFiles); // Sort alphabetically

// Helper function to check if file is a video
function isVideo($filename) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, ['mp4', 'webm', 'mov']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $currentSong;?> - The Final Trajectory</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="<?php echo $currentSong;?>.css">
</head>
<body class="song-page">
    <?php include 'includes/player.php'; ?>

    <nav class="breadcrumb">
        <a href="index.php">saturday</a> / <span><?php echo $currentSong;?></span>
    </nav>

    <div class="song-page-header">
        <h1 class="site-title"><a href="index.php">The Final Trajectory</a></h1>
        <h2 class="song-title-header"><?php echo $currentSong;?></h2>
    </div>

    <div class="masonry-container">
        <?php
        $itemCount = 0;
        foreach ($mediaFiles as $index => $mediaFile):
            $itemCount++;

            // Insert the text box after the 2nd item
            if ($itemCount === 3):
        ?>
            <div class="masonry-item masonry-item-text">
                <div class="song-explanation">
                    <h3><?php echo $currentSong;?></h3>
                    <p>Recorded on degraded tape loops between 1999-2001, this piece captures the essence of memory decay. The title references a specific frequency modulation discovered during late-night transmission experiments.</p>
                    <p>Layered synthesizers pass through analog filters, creating warm distortions that evoke childhood recollections filtered through decades. Each repetition degrades slightly, mimicking the way our memories fade and transform over time.</p>
                    <p>Listen for the recurring melodic fragment at 2:13—a deliberate callback to our earlier work, buried beneath static and time.</p>
                </div>
            </div>
        <?php
            endif;
        ?>

        <div class="masonry-item">
            <?php if (isVideo($mediaFile)): ?>
                <video controls>
                    <source src="<?php echo htmlspecialchars($mediaFile); ?>" type="video/<?php echo pathinfo($mediaFile, PATHINFO_EXTENSION); ?>">
                    Your browser does not support the video tag.
                </video>
            <?php else: ?>
                <img src="<?php echo htmlspecialchars($mediaFile); ?>" alt="<?php echo htmlspecialchars($currentSong . ' visual ' . ($index + 1)); ?>">
            <?php endif; ?>
        </div>

        <?php endforeach; ?>
    </div>

    <footer class="song-footer">
        <p><a href="index.php">← Back to Home</a></p>
    </footer>

    <script src="player.js"></script>
</body>
</html>
