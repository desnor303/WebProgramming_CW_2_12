<?php
require '../includes/DatabaseConnection.php';

$errors  = [];
$success = false;

$name    = '';
$email   = '';
$subject = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $errors[] = 'All fields are required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'INSERT INTO contacts (name, email, subject, message)
             VALUES (:name, :email, :subject, :message)'
        );
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message,
        ]);

        $success = true;
        $name = $email = $subject = $message = '';
    }
}

$title = 'Contact';

ob_start();
include '../templates/contact.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
