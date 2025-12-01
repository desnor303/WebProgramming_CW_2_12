<?php
// controller/users.php
require '../includes/DatabaseConnection.php';

// Lấy danh sách user, sắp xếp mới nhất lên trên
$sql = 'SELECT id, name, email, created_at 
        FROM users 
        ORDER BY created_at DESC';
$users = $pdo->query($sql)->fetchAll();

$title = 'Users';

ob_start();
require '../templates/users.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
