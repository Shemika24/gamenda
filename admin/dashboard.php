<?php
require_once '../includes/auth.php';
requireAdminAuth();

require_once '../includes/functions.php';

// Estatísticas
$totalGames = $pdo->query("SELECT COUNT(*) FROM games")->fetchColumn();
$totalDownloads = $pdo->query("SELECT SUM(download_count) FROM games")->fetchColumn();
$totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$recentGames = getGames(null, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gamenda Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Gamenda Admin</h1>
                <p class="text-gray-400 text-sm">Welcome, <?= $_SESSION['admin_username'] ?></p>
            </div>
            <nav class="mt-6">
                <a href="dashboard.php" class="block py-2 px-4 bg-purple-700">Dashboard</a>
                <a href="games.php" class="block py-2 px-4 hover:bg-gray-700">Games</a>
                <a href="categories.php" class="block py-2 px-4 hover:bg-gray-700">Categories</a>
                <a href="logout.php" class="block py-2 px-4 hover:bg-gray-700">Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h2>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <i data-feather="package" class="text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Games</p>
                                <p class="text-2xl font-bold"><?= $totalGames ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <i data-feather="download" class="text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Downloads</p>
                                <p class="text-2xl font-bold"><?= $totalDownloads ?: 0 ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i data-feather="grid" class="text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Categories</p>
                                <p class="text-2xl font-bold"><?= $totalCategories ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Games -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-medium">Recent Games</h3>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Downloads</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Added</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($recentGames as $game): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($game['title']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($game['category_name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $game['download_count'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= date('M j, Y', strtotime($game['created_at'])) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>