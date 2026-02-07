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
    <link rel="stylesheet" href="assets/css/style.css?v2">
</head>
<body>
    <canvas id="bifurcation-bg"></canvas>
    <?php include 'includes/player.php'; ?>

    <div class="container">
        <header>
            <h1 class="site-title" data-text="saturday 07:02:2026">saturday 07:02:2026</h1>
            <p class="tagline">an experiment by Mike // <a target="_blank" href="https://variousbits.net">variousbits.net</a></p>
        </header>

        <main class="home-content">
            <section class="home-about">
                <div class="about-text">
                    
                    <h3>What is this?</h3>
                    
                    <p>It's 7th February, 2026 and I'm home alone. Earlier in the week I decided to do some music today - and then that became "mic up the piano". 
                    And then that, dear reader, suddenly became "I know, I'll write 5 songs in a day" and then obviously because that was going to be easy (!) I then thought
                    "No! I'll write 5 songs AND make a little website to show them off. In a day."</p>
                                        
                    <p>The constraint is this: <strong>nothing</strong> from before today. I'm not allowed to re-hash ideas, take stuff I've recorded or written before. I'm allowed to use loops I've got lying around - but apart from that it's all got to be fresh out of my brain today.</p>
                    
                    <h3>Did the robots do this?</h3>
                    
                    <p>All of the music here is mine, and all of the images, and yes, I took them all today. Why have a constraint when you don't stick to the constraint? Anyway - there were no robots involved with the music, oh, maybe apart from N-Drums. The rest of it fell out of my brain, and my brain alone. Sorry about that.</p>
                    
                    <p>But...the website is entirely Claude generated. Claude, with me guiding a bit. It doesn't quite work (sorry about mobile in particular), and obviously I could spend ages fiddling. But, I'm tired as I write this, and the whole point of this experiment was that there is a time constraint.</p>
                    
                    <p>The track names below are indicative of the time that I started them. Basic process: lay something down, move on. Do all 5, then come back and do the (-cough-) "arranging". Sort out the website along the way.</p>
                    
                    <p>Are the tunes any good? I mean, they're not winning song of the year anytime soon. They're passable, and I'm proud enough of them to make a public website. But really as ever this was about the journey - and spending time noticing that constraints are sometimes a very good thing...</p>
                    
                    <p>Anyway. It's now 6:49 PM and I'm going for a lie down.</p>
                    
                    <p>Mike x</p>
                    
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
            <p>&copy; <?php echo date('Y'); ?> Mike Ellis</p>
        </footer>
    </div>

    <script src="bifurcation.js"></script>
    <script src="player.js"></script>
</body>
</html>
