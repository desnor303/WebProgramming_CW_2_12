<?php
// controller/deletemodule.php
require __DIR__ . '/../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;

if ($id && ctype_digit($id)) {
    $id = (int)$id;

    $stmt = $pdo->prepare('DELETE FROM modules WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

header('Location: modules.php');
exit;
