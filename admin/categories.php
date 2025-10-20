<?php
require_once '../includes/auth.php';
requireAdminAuth();

require_once '../includes/functions.php';

// Adicionar/Editar categoria
if ($_POST) {
    $id = $_POST['id'] ?? 0;
    $name = $_POST['name'] ?? '';
    $slug = $_POST['slug'] ?? '';
    
    if (empty($slug)) {
        $slug = slugify($name);
    }
    
    if ($id) {
        // Editar categoria
        $stmt = $pdo->prepare("UPDATE categories SET name = ?, slug = ? WHERE id = ?");
        $stmt->execute([$name, $slug, $id]);
    } else {
        // Adicionar categoria
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        $stmt->execute([$name, $slug]);
    }
    
    header('Location: categories.php');
    exit;
}

// Deletar categoria
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Verificar se há jogos nesta categoria
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM games WHERE category_id = ?");
    $stmt->execute([$id]);
    $gameCount = $stmt->fetchColumn();
    
    if ($gameCount > 0) {
        $_SESSION['error'] = 'Cannot delete category with associated games. Please reassign or delete the games first.';
    } else {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = 'Category deleted successfully.';
    }
    
    header('Location: categories.php');
    exit;
}

// Buscar categorias
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

// Mensagens
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Gamenda Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Gamenda Admin</h1>
                <p class="text-gray-400 text-sm">Welcome, <?= $_SESSION['admin_username'] ?></p>
            </div>
            <nav class="mt-6">
                <a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a>
                <a href="games.php" class="block py-2 px-4 hover:bg-gray-700">Games</a>
                <a href="categories.php" class="block py-2 px-4 bg-purple-700">Categories</a>
                <a href="logout.php" class="block py-2 px-4 hover:bg-gray-700">Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Manage Categories</h2>
                    <button onclick="openModal()" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 flex items-center gap-2">
                        <i data-feather="plus"></i>
                        Add New Category
                    </button>
                </div>

                <!-- Messages -->
                <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?= htmlspecialchars($success) ?>
                </div>
                <?php endif; ?>

                <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <!-- Categories Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Games Count</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($categories)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No categories found. Add your first category!
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($categories as $category): 
                                // Count games in this category
                                $stmt = $pdo->prepare("SELECT COUNT(*) FROM games WHERE category_id = ?");
                                $stmt->execute([$category['id']]);
                                $gameCount = $stmt->fetchColumn();
                                ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($category['name']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?= htmlspecialchars($category['slug']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('M j, Y', strtotime($category['created_at'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= $gameCount ?> games
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editCategory(<?= htmlspecialchars(json_encode($category)) ?>)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                        <a href="categories.php?delete=<?= $category['id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Stats -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <i data-feather="grid" class="text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Categories</p>
                                <p class="text-2xl font-bold"><?= count($categories) ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <i data-feather="package" class="text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Games</p>
                                <p class="text-2xl font-bold">
                                    <?= $pdo->query("SELECT COUNT(*) FROM games")->fetchColumn() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i data-feather="trending-up" class="text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Most Popular Category</p>
                                <p class="text-2xl font-bold">
                                    <?php
                                    $stmt = $pdo->query("
                                        SELECT c.name, COUNT(g.id) as game_count 
                                        FROM categories c 
                                        LEFT JOIN games g ON c.id = g.category_id 
                                        GROUP BY c.id 
                                        ORDER BY game_count DESC 
                                        LIMIT 1
                                    ");
                                    $popular = $stmt->fetch();
                                    echo $popular ? htmlspecialchars($popular['name']) : 'None';
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-bold mb-4" id="modalTitle">Add New Category</h3>
            <form method="POST">
                <input type="hidden" name="id" id="categoryId">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" name="name" id="name" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-purple-500 focus:border-purple-500"
                               oninput="updateSlug()">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" name="slug" id="slug" 
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-purple-500 focus:border-purple-500"
                               placeholder="auto-generated">
                        <p class="mt-1 text-sm text-gray-500">URL-friendly version of the name</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Save Category</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Add New Category';
            document.getElementById('categoryId').value = '';
            document.getElementById('name').value = '';
            document.getElementById('slug').value = '';
        }

        function editCategory(category) {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Edit Category';
            document.getElementById('categoryId').value = category.id;
            document.getElementById('name').value = category.name;
            document.getElementById('slug').value = category.slug;
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        function updateSlug() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            
            // Only update slug if it's empty or matches the auto-generated pattern
            if (!slugInput.value || slugInput.value === slugify(nameInput.value)) {
                slugInput.value = slugify(nameInput.value);
            }
        }

        function slugify(text) {
            return text
                .toString()
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w-]+/g, '')
                .replace(/--+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        // Close modal when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        feather.replace();
    </script>
</body>
</html>