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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/player.php'; ?>

    <div class="container">
        <header>
            <h1 class="site-title">saturday 07:02:2026</h1>
            <p class="tagline">an experiment by Mike // <a target="_blank" href="https://variousbits.net">variousbits.net</a></p>
        </header>

        <main class="home-content">
            <section class="home-about">
                <div class="about-text">
                    
                    <h3>What is this?</h3>
                    
                    <p>It's 7th February, 2026 and I'm home alone. Earlier in the week I decided to do some music today - and then that became "mic up the piano". 
                    And then that, dear reader, suddenly became "I know, I'll write 5 songs in a day" and then obviously because that was going to be easy (!) I then thought
                    "No! I'll write 5 songs AND make a little website to show them off. In a day."</p>
                    
                    <h3>What, why?</h3>
                    
                    <p>I wanted to push at the interface between AI and human. I have very little interest in Suno, and I don't understand anyone who uses tools to "generate" music. 
                    But... I'm also fascinated with the edge between robots and us, and how we can use these tools to enhance our creativity, rather than replace it.</p>
                    
                    <p>All of the music here is mine. There were no robots involved, oh, maybe apart from N-Drums. The rest of it fell out of my brain, and my brain alone. Sorry about that.</p>
                    
                    <p>But...the website is entirely Claude generated. Claude, with me guiding a bit. It doesn't quite work, and obviously I could spend ages fiddling. But, I'm tired as I write this, and the whole point of this experiment was that there is a time constraint.</p>
                    
                    <p>The track names below are indicative of the time that I started them. Basic process: lay something down, move on. Do all 5, then come back and do the (-cough-) "arranging". Sort out the website along the way.</p>
                    
                    <p>It's now 6:19 PM and I'm going for a lie down.</p>
                    
                </div>
            </section>

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
