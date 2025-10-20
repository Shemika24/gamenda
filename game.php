<?php
require_once 'includes/functions.php';

$slug = $_GET['slug'] ?? '';
$game = getGameBySlug($slug);

if (!$game) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['download'])) {
    incrementDownloadCount($game['id']);
    header('Location: ' . $game['file_url']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($game['title']) ?> - Gamenda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Ubuntu:wght@400;500;700&display=swap');
        .font-pixel { font-family: 'Press Start 2P', cursive; }
        .font-main { font-family: 'Ubuntu', sans-serif; }
    </style>
</head>
<body class="font-main bg-gray-900 text-white">
    <!-- Navigation -->
    <nav class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="font-pixel text-xl text-purple-400">GAMENDA</a>
                </div>
                <a href="index.php" class="text-gray-300 hover:text-white">← Back to Games</a>
            </div>
        </div>
    </nav>

    <!-- Game Details -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Game Image -->
            <div>
                <?php if ($game['image_url']): ?>
                    <img src="<?= htmlspecialchars($game['image_url']) ?>" alt="<?= htmlspecialchars($game['title']) ?>" class="w-full rounded-lg shadow-2xl">
                <?php else: ?>
                    <div class="w-full h-96 bg-gradient-to-br from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">Game Image</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Game Info -->
            <div>
                <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($game['title']) ?></h1>
                <div class="flex items-center gap-4 mb-6">
                    <span class="bg-purple-600 px-3 py-1 rounded-full text-sm"><?= htmlspecialchars($game['category_name']) ?></span>
                    <span class="<?= $game['is_premium'] ? 'bg-yellow-600' : 'bg-green-600' ?> px-3 py-1 rounded-full text-sm">
                        <?= $game['is_premium'] ? 'PREMIUM' : 'FREE' ?>
                    </span>
                </div>

                <div class="flex items-center gap-6 mb-6">
                    <div class="flex items-center gap-2">
                        <i data-feather="star" class="text-yellow-400" fill="currentColor"></i>
                        <span><?= $game['rating'] ?> Rating</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-feather="download"></i>
                        <span><?= $game['download_count'] ?> Downloads</span>
                    </div>
                    <?php if ($game['version']): ?>
                    <div class="flex items-center gap-2">
                        <i data-feather="tag"></i>
                        <span>v<?= $game['version'] ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-3">Description</h3>
                    <p class="text-gray-300 leading-relaxed"><?= nl2br(htmlspecialchars($game['description'])) ?></p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-3">Game Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-400">Category:</span>
                            <p class="font-medium"><?= htmlspecialchars($game['category_name']) ?></p>
                        </div>
                        <div>
                            <span class="text-gray-400">Status:</span>
                            <p class="font-medium"><?= $game['is_premium'] ? 'Premium' : 'Free' ?></p>
                        </div>
                        <?php if ($game['file_size']): ?>
                        <div>
                            <span class="text-gray-400">File Size:</span>
                            <p class="font-medium"><?= $game['file_size'] ?></p>
                        </div>
                        <?php endif; ?>
                        <div>
                            <span class="text-gray-400">Added:</span>
                            <p class="font-medium"><?= date('M j, Y', strtotime($game['created_at'])) ?></p>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    <button type="submit" name="download" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 flex items-center justify-center gap-3">
                        <i data-feather="download"></i>
                        Download Now
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>