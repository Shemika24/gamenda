<?php
require_once '../includes/auth.php';
requireAdminAuth();

require_once '../includes/functions.php';

$categories = getAllCategories();

// Adicionar/Editar jogo
if ($_POST) {
    $id = $_POST['id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $file_url = $_POST['file_url'] ?? '';
    $image_url = $_POST['image_url'] ?? '';
    $file_size = $_POST['file_size'] ?? '';
    $version = $_POST['version'] ?? '';
    $rating = $_POST['rating'] ?? 0;
    $is_premium = isset($_POST['is_premium']) ? 1 : 0;
    $status = $_POST['status'] ?? 'active';
    
    if ($id) {
        // Editar
        $stmt = $pdo->prepare("UPDATE games SET title=?, description=?, category_id=?, file_url=?, image_url=?, file_size=?, version=?, rating=?, is_premium=?, status=? WHERE id=?");
        $stmt->execute([$title, $description, $category_id, $file_url, $image_url, $file_size, $version, $rating, $is_premium, $status, $id]);
    } else {
        // Adicionar
        $slug = slugify($title);
        $stmt = $pdo->prepare("INSERT INTO games (title, slug, description, category_id, file_url, image_url, file_size, version, rating, is_premium, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $description, $category_id, $file_url, $image_url, $file_size, $version, $rating, $is_premium, $status]);
    }
    
    header('Location: games.php');
    exit;
}

// Deletar jogo
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: games.php');
    exit;
}

// Buscar jogos
$games = $pdo->query("SELECT g.*, c.name as category_name FROM games g LEFT JOIN categories c ON g.category_id = c.id ORDER BY g.created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Games - Gamenda Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Gamenda Admin</h1>
            </div>
            <nav class="mt-6">
                <a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a>
                <a href="games.php" class="block py-2 px-4 bg-purple-700">Games</a>
                <a href="categories.php" class="block py-2 px-4 hover:bg-gray-700">Categories</a>
                <a href="logout.php" class="block py-2 px-4 hover:bg-gray-700">Logout</a>
            </nav>
        </div>

        <div class="flex-1 overflow-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Manage Games</h2>
                    <button onclick="openModal()" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                        Add New Game
                    </button>
                </div>

                <!-- Games Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Downloads</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($games as $game): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($game['title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($game['category_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $game['download_count'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded <?= $game['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= ucfirst($game['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="editGame(<?= htmlspecialchars(json_encode($game)) ?>)" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <a href="games.php?delete=<?= $game['id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="gameModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4">
            <h3 class="text-2xl font-bold mb-4" id="modalTitle">Add New Game</h3>
            <form method="POST">
                <input type="hidden" name="id" id="gameId">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">File URL</label>
                            <input type="url" name="file_url" id="file_url" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image URL</label>
                            <input type="url" name="image_url" id="image_url" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">File Size</label>
                            <input type="text" name="file_size" id="file_size" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="e.g., 1.2 GB">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Version</label>
                            <input type="text" name="version" id="version" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="e.g., 1.0.0">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rating</label>
                            <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_premium" id="is_premium" class="mr-2">
                            <label class="text-sm font-medium text-gray-700">Premium Game</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Save Game</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('gameModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Add New Game';
            document.getElementById('gameId').value = '';
            document.getElementById('title').value = '';
            document.getElementById('description').value = '';
            document.getElementById('category_id').value = '';
            document.getElementById('file_url').value = '';
            document.getElementById('image_url').value = '';
            document.getElementById('file_size').value = '';
            document.getElementById('version').value = '';
            document.getElementById('rating').value = '0';
            document.getElementById('is_premium').checked = false;
            document.getElementById('status').value = 'active';
        }

        function editGame(game) {
            document.getElementById('gameModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Edit Game';
            document.getElementById('gameId').value = game.id;
            document.getElementById('title').value = game.title;
            document.getElementById('description').value = game.description;
            document.getElementById('category_id').value = game.category_id;
            document.getElementById('file_url').value = game.file_url;
            document.getElementById('image_url').value = game.image_url;
            document.getElementById('file_size').value = game.file_size;
            document.getElementById('version').value = game.version;
            document.getElementById('rating').value = game.rating;
            document.getElementById('is_premium').checked = game.is_premium;
            document.getElementById('status').value = game.status;
        }

        function closeModal() {
            document.getElementById('gameModal').classList.add('hidden');
        }

        feather.replace();
    </script>
</body>
</html>