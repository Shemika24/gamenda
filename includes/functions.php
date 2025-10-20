<?php
require_once 'config.php';

function getAllCategories() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
    return $stmt->fetchAll();
}

function getGames($category = null, $limit = null) {
    global $pdo;
    
    $sql = "SELECT g.*, c.name as category_name 
            FROM games g 
            LEFT JOIN categories c ON g.category_id = c.id 
            WHERE g.status = 'active'";
    
    $params = [];
    
    if ($category && $category != 'all') {
        $sql .= " AND c.slug = ?";
        $params[] = $category;
    }
    
    $sql .= " ORDER BY g.created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT ?";
        $params[] = $limit;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getGameBySlug($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT g.*, c.name as category_name 
                          FROM games g 
                          LEFT JOIN categories c ON g.category_id = c.id 
                          WHERE g.slug = ? AND g.status = 'active'");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function incrementDownloadCount($gameId) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE games SET download_count = download_count + 1 WHERE id = ?");
    $stmt->execute([$gameId]);
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    
    if (empty($text)) {
        return 'n-a';
    }
    
    return $text;
}
?>