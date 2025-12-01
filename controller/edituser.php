<?php
// controller/edituser.php
require '../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) {
    header('Location: users.php');
    exit;
}

$errors = [];

$stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: users.php');
    exit;
}

$name  = $user['name'];
$email = $user['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '') {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'UPDATE users 
             SET name = :name, email = :email 
             WHERE id = :id'
        );
        $stmt->execute([
            ':name'  => $name,
            ':email' => $email,
            ':id'    => $id,
        ]);

        header('Location: users.php');
        exit;
    }
}

$formTitle   = 'Edit User';
$submitLabel = 'Save Changes';

$title = $formTitle;

ob_start();
require '../templates/user_form.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
