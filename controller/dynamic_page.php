<?php
require '../includes/DatabaseConnection.php';

$page_id = $_GET['page_id'] ?? null;
if (!$page_id || !ctype_digit($page_id)) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM generated_page WHERE id = :id');
$stmt->execute([':id' => $page_id]);
$page = $stmt->fetch();

if (!$page) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare(
    'SELECT * FROM generated_page_field 
     WHERE page_id = :page_id ORDER BY position'
);
$stmt->execute([':page_id' => $page_id]);
$fields = $stmt->fetchAll();

$table_name = $page['table_name'];

$cols = ['id', 'created_at'];
if ($page['has_image']) {
    $cols[] = 'image_path';
}
foreach ($fields as $f) {
    $cols[] = $f['field_name'];
}

$sql = 'SELECT ' . implode(',', $cols) . ' FROM `' . $table_name . '` ORDER BY created_at DESC';
$result = $pdo->query($sql);
$rows   = $result->fetchAll();

$title = $page['name'];

ob_start();
include '../templates/dynamic_page.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
