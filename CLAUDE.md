# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

"The Final Trajectory" is a Boards of Canada-inspired band website featuring 5 songs with a persistent audio player. The site uses vanilla PHP, HTML, CSS, and JavaScript without any frameworks.

## Directory Structure

```
_WEBSITE/
├── index.php              # Homepage with track listing
├── 13-50.php              # Song page for "13-50" (template for other songs)
├── style.css              # Boards of Canada aesthetic styling
├── player.js              # Persistent audio player logic
├── includes/
│   └── player.php         # Audio player component (included on all pages)
└── assets/
    ├── audio/             # MP3 files (will contain 5 songs)
    ├── images/            # Image assets
    └── video/             # Video assets
```

## Development Setup

### Local PHP Server

Run the development server from the project root:

```bash
php -S localhost:8000
```

Then visit: http://localhost:8000/index.php

### Adding New Song Pages

To add a new song page:

1. Copy `13-50.php` to create a new file named after the song (e.g., `new-song.php`)
2. Update the `$currentSong` variable to match the filename without extension
3. Modify the `<title>` and `.song-title` to reflect the new song name
4. Add the corresponding MP3 file to `assets/audio/` - the player will automatically detect it

## Architecture

### Persistent Audio Player

The audio player persists across page navigations using `localStorage`:
- Player state (current track, playback position, play/pause state) is saved continuously
- When navigating between pages, the player restores its previous state
- All pages include `includes/player.php` which renders the fixed-position player
- `player.js` handles all player logic and state management

### Audio File Discovery

The PHP backend automatically scans `assets/audio/` for MP3 files using `glob()`:
- No hardcoded song list required
- Songs are dynamically populated on all pages
- Both index and song pages generate navigation from the discovered files

### Styling

Boards of Canada aesthetic features:
- Vintage color palette (aged beige, muted orange, faded teal)
- Monospace typography (Courier New)
- Analog warmth with gradient backgrounds
- Scanline overlay effect for vintage feel
- Fixed audio player at bottom with dark theme

## Design Notes

- Date format preference: dd-mm-yyyy
- Keep the minimalist, nostalgic aesthetic consistent with Boards of Canada's visual identity
- The player uses localStorage for persistence - browser must support it
- Auto-play may be blocked by browsers; user will need to manually start playback on first visit
