<?php
// controller/adduser.php
require '../includes/DatabaseConnection.php';

$errors = [];
$name   = '';
$email  = '';

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
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO users (name, email, password_hash, role)
                 VALUES (:name, :email, :pass, :role)'
            );
            $stmt->execute([
                ':name'  => $name,
                ':email' => $email,
                ':pass'  => password_hash('password', PASSWORD_DEFAULT),
                ':role'  => 'user',
            ]);

            header('Location: users.php');
            exit;
        } catch (PDOException $e) {
            // 23000 + 1062 = lỗi unique constraint (trùng email)
            if ($e->getCode() === '23000') {
                $errors[] = 'This email address is already registered.';
            } else {
                // Các lỗi khác thì quăng ra để còn biết debug
                throw $e;
            }
        }
    }
}

$formTitle   = 'Add New User';
$submitLabel = 'Add User';

$title = $formTitle;

ob_start();
require '../templates/user_form.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
