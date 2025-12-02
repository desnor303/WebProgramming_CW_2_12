<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'CW Builder' ?></title>

    <!-- File này luôn được include từ /controller/*.php nên dùng ../ -->
    <link rel="stylesheet" href="../public/styles.css">
    <script src="../public/theme.js" defer></script>
</head>
<body>
    <header>

        <button id="theme-toggle" type="button" class="btn-theme">Dark</button>


        <h1>COMP1841 Coursework – Student Question Forum</h1>
    </header>

    <!-- Secure area navigation: -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = !empty($_SESSION['Authorised']) && $_SESSION['Authorised'] === 'Y';
?>

    <nav>
        <ul>
             <li><a href="index.php">Home</a></li>
            <li><a href="addquestion.php">Add Question</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="modules.php">Modules</a></li>
            <li><a href="contact.php">Contact</a></li>
            <!-- <li><a href="page_builder.php">Page Builder</a></li> -->
            <?php if ($isLoggedIn): ?>
                <li><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user_name'] ?? 'User', ENT_QUOTES, 'UTF-8') ?>)</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Main: CSS đã set width 65%, card, shadow… -->
    <main>
        <?= $output ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> CW Builder Project</p>
    </footer>
</body>
</html>
