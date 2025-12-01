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
        <!-- Nút dark mode: đúng id + class mà CSS & JS mong đợi -->
        <button id="theme-toggle" type="button" class="btn-theme">Dark</button>

        <!-- Tiêu đề to ở giữa – CSS đã style sẵn header h1 -->
        <h1>COMP1841 Coursework – Student Question Forum</h1>
    </header>

    <!-- Nav đúng cấu trúc mà CSS mong đợi: nav > ul > li > a -->
    <nav>
        <ul>
            <!-- Các link đều trỏ tới file trong thư mục /controller -->
            <li><a href="index.php">Questions</a></li>
            <li><a href="addquestion.php">Add Question</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="modules.php">Modules</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="page_builder.php">Page Builder</a></li>
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
