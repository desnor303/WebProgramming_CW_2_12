<?php
// controller/addmodule.php
require '../includes/check.php';

require '../includes/DatabaseConnection.php';

$errors      = [];
$name        = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($name === '') {
        $errors[] = 'Module name is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'INSERT INTO modules (name, description)
             VALUES (:name, :description)'
        );
        $stmt->execute([
            ':name'        => $name,
            ':description' => $description,
        ]);

        header('Location: modules.php');
        exit;
    }
}

$formTitle   = 'Add New Module';
$submitLabel = 'Add Module';

$title = $formTitle;

ob_start();
require '../templates/module_form.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
