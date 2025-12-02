<?php
// controller/notauthorised.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = 'Not authorised';

ob_start();
require '../templates/notauthorised.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
