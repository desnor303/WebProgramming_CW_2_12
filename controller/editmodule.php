<?php
// controller/editmodule.php
require '../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) {
    header('Location: modules.php');
    exit;
}

$errors = [];

$stmt = $pdo->prepare('SELECT id, name, description FROM modules WHERE id = :id');
$stmt->execute([':id' => $id]);
$module = $stmt->fetch();

if (!$module) {
    header('Location: modules.php');
    exit;
}

$name        = $module['name'];
$description = $module['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($name === '') {
        $errors[] = 'Module name is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'UPDATE modules
             SET name = :name, description = :description
             WHERE id = :id'
        );
        $stmt->execute([
            ':name'        => $name,
            ':description' => $description,
            ':id'          => $id,
        ]);

        header('Location: modules.php');
        exit;
    }
}

$formTitle   = 'Edit Module';
$submitLabel = 'Save Changes';

$title = $formTitle;

ob_start();
require '../templates/module_form.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
