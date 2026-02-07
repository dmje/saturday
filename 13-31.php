<?php
$currentPage = '13-31';
$currentSong = '13-31';
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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/<?php echo $currentSong;?>.css">
    <script defer src="https://simplestats.thirty8.co.uk/script.js" data-website-id="431dec11-3871-416f-90f1-fa919989d3e5"></script>
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
                    <p>Started this one on Ableton Note, then did the cloud thing to get it into Live and adapt from there.</p>
                    <p>Heavy old beat. The overlay arp has a lovely glitchy thing as it pitchbends at the end of the phrase.</p>
                    <p>Laid down the bass part when back in the studio as night came on...</p>
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
