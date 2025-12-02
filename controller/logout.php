<?php
// controller/logout.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_destroy();

// quay về form login (giống Logout.php trong slide)
header('Location: login.php');
exit;
