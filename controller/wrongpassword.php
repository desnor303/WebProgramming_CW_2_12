<?php
// controller/wrongpassword.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = 'Wrong password';

ob_start();
require '../templates/wrongpassword.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
