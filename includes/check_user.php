<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['Authorised']) || $_SESSION['Authorised'] !== 'Y' ||
    empty($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['user', 'admin'])
) {
    header('Location: notauthorised.php');
    exit;
}
