// Animated bifurcation diagram background
(function() {
    const canvas = document.getElementById('bifurcation-bg');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height;
    let drift = 0;
    let frameId;

    function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    }

    function drawBifurcation(rOffset) {
        ctx.clearRect(0, 0, width, height);

        // r ranges from ~2.5 to 4.0 across the screen width
        const rMin = 2.5 + rOffset;
        const rMax = 4.0 + rOffset * 0.3;
        const iterations = 300;
        const settle = 200;

        // Draw with subtle cyan/purple tones
        const colors = [
            'rgba(74, 240, 225, 0.6)',   // cyan
            'rgba(139, 92, 246, 0.4)',    // purple
            'rgba(59, 130, 246, 0.3)',    // blue
        ];

        for (let px = 0; px < width; px += 1) {
            const r = rMin + (px / width) * (rMax - rMin);
            let x = 0.5;

            // Settle into attractor
            for (let i = 0; i < settle; i++) {
                x = r * x * (1 - x);
            }

            // Plot the attractor points
            for (let i = 0; i < iterations; i++) {
                x = r * x * (1 - x);

                if (x > 0 && x < 1) {
                    const py = height - x * height;
                    const colorIdx = i % colors.length;
                    ctx.fillStyle = colors[colorIdx];
                    ctx.fillRect(px, py, 1.2, 1.2);
                }
            }
        }

        // Add a faint horizontal glitch line that moves
        const glitchY = (Math.sin(drift * 0.7) * 0.5 + 0.5) * height;
        ctx.fillStyle = 'rgba(74, 240, 225, 0.08)';
        ctx.fillRect(0, glitchY, width, 2);

        // Second glitch line
        const glitchY2 = (Math.cos(drift * 0.4 + 1) * 0.5 + 0.5) * height;
        ctx.fillStyle = 'rgba(139, 92, 246, 0.06)';
        ctx.fillRect(0, glitchY2, width, 1);
    }

    // Render at low frequency for performance
    let lastDraw = 0;
    const drawInterval = 3000; // redraw every 3 seconds

    function animate(timestamp) {
        if (timestamp - lastDraw > drawInterval) {
            drift += 0.008;
            // Keep drift small so diagram doesn't go out of range
            if (drift > 0.3) drift = -0.1;
            drawBifurcation(drift);
            lastDraw = timestamp;
        }
        frameId = requestAnimationFrame(animate);
    }

    resize();
    drawBifurcation(0);

    window.addEventListener('resize', () => {
        resize();
        drawBifurcation(drift);
    });

    // Start slow animation
    frameId = requestAnimationFrame(animate);

    // Reduce CPU when tab is hidden
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(frameId);
        } else {
            frameId = requestAnimationFrame(animate);
        }
    });
})();
