<?php
require_once 'includes/functions.php';

$category = $_GET['category'] ?? 'all';
$games = getGames($category);
$categories = getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--partners-house-->
    <meta confirm="partners-house-190191"/>
    <script type="text/javascript" src="https://hotblikawo.today/process.js?id=1505839611&p1=sub1&p2=sub2&p3=sub3&p4=sub4" async> </script> <!--webpush-->
    <script type="text/javascript" src="https://hotblikawo.today/process.js?id=1505839611&p1=sub1&p2=sub2&p3=sub3&p4=sub4" async> </script> <!--inpage-->
     <!--monetag-->
    <script src="https://fpyf8.com/88/tag.min.js" data-zone="179258" async data-cfasync="false"></script>
    <title>Gamenda - Your Game Universe</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Ubuntu:wght@400;500;700&display=swap');
        .font-pixel {
            font-family: 'Press Start 2P', cursive;
        }
        .font-main {
            font-family: 'Ubuntu', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #6e45e2 0%, #88d3ce 100%);
        }
        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .category-filters {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .category-btn {
            padding: 8px 20px;
            background-color: #374151;
            border: 2px solid #4B5563;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            color: white;
        }
        
        .category-btn.active, .category-btn:hover {
            background-color: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }
        
        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
    </style>
</head>
<body class="font-main bg-gray-900 text-white">
    <div id="vanta-bg" class="fixed top-0 left-0 w-full h-full z-0"></div>
    <div class="relative z-10">
        <!-- Navigation -->
        <nav class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="index.php" class="font-pixel text-xl text-purple-400">GAMENDA</a>
                        </div>
                       <div class="hidden md:block">
    <div class="ml-10 flex items-baseline space-x-4">
        <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium bg-purple-600 text-white">Home</a>
        <a href="index.php#games" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">Games</a>
        <a href="index.php#categories" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">Categories</a>
        <a href="about.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">About</a>
        <a href="admin/login.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">Admin</a>
    </div>
</div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <div class="search-bar flex items-center bg-gray-700 rounded-full px-4 py-2">
                                <i data-feather="search" class="text-gray-400 mr-2"></i>
                                <input type="text" placeholder="Search games..." class="bg-transparent border-none focus:outline-none text-white w-40">
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none" aria-expanded="false">
                            <i data-feather="menu"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="hero-gradient">
            <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-pixel mb-6 text-white">
                    <span class="text-purple-300">PLAY</span> <span class="text-cyan-300">DOWNLOAD</span> <span class="text-white">REPEAT</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    Your ultimate gaming destination with thousands of free and premium games across all platforms.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#games" class="px-8 py-3 rounded-full text-lg font-medium bg-white text-purple-600 hover:bg-gray-100 transition duration-300">
                        <i data-feather="download" class="inline mr-2"></i> Browse Games
                    </a>
                </div>
            </div>
        </header>

        <!-- Categories Section -->
        <section id="games" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-pixel text-center text-purple-400 mb-12">GAME CATEGORIES</h2>
            
            <div class="category-filters">
                <button class="category-btn <?= $category == 'all' ? 'active' : '' ?>" data-category="all">All</button>
                <?php foreach ($categories as $cat): ?>
                <button class="category-btn <?= $category == $cat['slug'] ? 'active' : '' ?>" data-category="<?= $cat['slug'] ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </button>
                <?php endforeach; ?>
            </div>
            
            <div class="games-grid">
                <?php if (empty($games)): ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-400 text-xl">No games found in this category.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($games as $game): ?>
                    <div class="game-card bg-gray-800 rounded-lg overflow-hidden transition duration-300 transform hover:scale-105" data-category="<?= $game['category_name'] ?>">
                        <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center">
                            <?php if ($game['image_url']): ?>
                                <img src="<?= htmlspecialchars($game['image_url']) ?>" alt="<?= htmlspecialchars($game['title']) ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-white font-bold">Game Image</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold"><?= htmlspecialchars($game['title']) ?></h3>
                                <span class="<?= $game['is_premium'] ? 'bg-yellow-600' : 'bg-green-600' ?> text-xs px-2 py-1 rounded">
                                    <?= $game['is_premium'] ? 'PREMIUM' : 'FREE' ?>
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-4"><?= htmlspecialchars($game['description']) ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-yellow-400">
                                    <i data-feather="star" class="inline" fill="currentColor"></i> <?= $game['rating'] ?>
                                </span>
                                <span class="text-gray-400 text-sm">
                                    <i data-feather="download" class="inline"></i> <?= $game['download_count'] ?>
                                </span>
                            </div>
                            <div class="mt-4">
                                <a href="game.php?slug=<?= $game['slug'] ?>" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-2 rounded transition duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Category Icons Section -->
        <section id="categories" class="py-16 bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-pixel text-center text-purple-400 mb-12">GAME CATEGORIES</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <?php foreach ($categories as $cat): ?>
                    <a href="index.php?category=<?= $cat['slug'] ?>" class="category-card bg-gray-700 rounded-lg p-6 text-center hover:bg-purple-600 transition duration-300">
                        <div class="bg-purple-500 rounded-full p-3 inline-block mb-3">
                            <i data-feather="gamepad" class="text-white h-6 w-6"></i>
                        </div>
                        <h3 class="font-medium"><?= htmlspecialchars($cat['name']) ?></h3>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="font-pixel text-white text-lg mb-4">GAMENDA</h3>
                        <p class="text-gray-400">
                            Your ultimate gaming destination with thousands of free and premium games across all platforms.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-white font-medium mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                            <li><a href="#games" class="text-gray-400 hover:text-white">Games</a></li>
                            <li><a href="#categories" class="text-gray-400 hover:text-white">Categories</a></li>
                            <li><a href="admin/login.php" class="text-gray-400 hover:text-white">Admin</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-medium mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="terms.php" class="text-gray-400 hover:text-white">Terms of Service</a></li>
<li><a href="privacy.php" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
<li><a href="cookies.php" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
<li><a href="dmca.php" class="text-gray-400 hover:text-white">DMCA</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-medium mb-4">Contact</h4>
                        <ul class="space-y-2">
                            <li class="text-gray-400">Email: contact@gamenda.com</li>
                            <li class="text-gray-400">Support: support@gamenda.com</li>
                            <li class="text-gray-400">Social: @gamendaofficial</li>
                        </ul>
                        <div class="mt-4">
                            <p class="text-gray-400 text-sm">
                                © 2023 Gamenda. All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Initialize Vanta.js background
        VANTA.NET({
            el: "#vanta-bg",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x7c3aed,
            backgroundColor: 0x111827,
            points: 12.00,
            maxDistance: 24.00,
            spacing: 18.00
        });

        // Category filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
            
            const categoryButtons = document.querySelectorAll('.category-btn');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    window.location.href = `index.php?category=${category}`;
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-bar input');
            const gameCards = document.querySelectorAll('.game-card');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                gameCards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    if (title.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>