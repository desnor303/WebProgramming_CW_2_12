<?php
// controller/login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../includes/DatabaseConnection.php';

$errors = [];
$email  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '') {
        $errors[] = 'Email is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (empty($errors)) {
        // Tìm user theo email
        $stmt = $pdo->prepare(
            'SELECT id, name, email, password_hash, role 
             FROM users 
             WHERE email = :email'
        );
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);

            $_SESSION['Authorised'] = 'Y';          // giống slide
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_role']  = $user['role']; // 'admin' / 'student' nếu có

            header('Location: index.php');
            exit;
        } else {
            // Sai email hoặc password -> giống Validate.php => Wrongpassword.php
            header('Location: wrongpassword.php');
            exit;
        }
    }
}

$title = 'Login';

ob_start();
require '../templates/login.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
