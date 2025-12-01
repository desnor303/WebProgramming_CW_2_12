<?php
// controller/deleteuser.php
require __DIR__ . '/../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if ($id && ctype_digit($id)) {
    $id = (int)$id;

    // Nếu có FK ON DELETE CASCADE với questions thì xoá user sẽ xoá luôn questions
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

header('Location: users.php');
exit;
