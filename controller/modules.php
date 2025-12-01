<?php
// controller/modules.php
require '../includes/DatabaseConnection.php';

$sql = 'SELECT id, name, description, created_at
        FROM modules
        ORDER BY created_at DESC';
$modules = $pdo->query($sql)->fetchAll();

$title = 'Modules';

ob_start();
require '../templates/modules.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
