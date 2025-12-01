<?php
// includes/DatabaseConnection.php

$dsn = 'mysql:host=localhost;dbname=cw_builder;charset=utf8mb4';
$username = 'root';
$password = ''; // fill in  database password

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $output = 'Unable to connect to the database: ' . $e->getMessage();
    include __DIR__ . '/../templates/layout.html.php';
    exit;
}
