<?php
session_start();

define('DB_HOST', 'sql213.infinityfree.com');
define('DB_NAME', 'if0_40162566_gamenda');
define('DB_USER', 'if0_40162566');
define('DB_PASS', '9E72kXD03fAt5I5');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Configurações do site
define('SITE_NAME', 'Gamenda');
define('SITE_URL', 'https://gamenda.vercel.app/');
define('UPLOAD_PATH', __DIR__ . '/../static/uploads/');
?>