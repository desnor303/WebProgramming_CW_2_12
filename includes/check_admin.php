<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['Authorised']) || $_SESSION['Authorised'] !== 'Y' ||
    empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'
) {
    header('Location: notauthorised.php');
    exit;
}
