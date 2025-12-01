<?php
// controller/page_builder.php
require '../includes/DatabaseConnection.php';

$errors = [];

// init vars (ensure defined for first load)
$name      = '';
$slug      = '';
$tableName = '';
$hasImage  = 0;
$hasDate   = 1; // date is required
$hasUser   = 1; // if you want to toggle this, you can set it to 0
$hasModule = 1;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name      = trim($_POST['name'] ?? '');
    $slug      = trim($_POST['slug'] ?? '');
    $tableName = trim($_POST['tableName'] ?? '');

    $hasImage  = isset($_POST['hasImage']) ? 1 : 0;
    $hasDate   = isset($_POST['hasDate']) ? 1 : 0;
    $hasUser   = isset($_POST['hasUser']) ? 1 : 0;
    $hasModule = isset($_POST['hasModule']) ? 1 : 0;

    if ($name === '') {
        $errors[] = 'Page name is required.';
    }
    if ($slug === '') {
        $errors[] = 'Slug is required.';
    }
    if ($tableName === '') {
        $errors[] = 'Database table name is required.';
    }

    // Ensure at least 1 text content field
    // (in a full version you could add separate field configs; here we use 1 common text column)
    if (empty($errors)) {
        try {
            // 1. Create new data table
            $columns = [];
            $columns[] = '`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY';
            $columns[] = '`text` TEXT NOT NULL';

            if ($hasImage) {
                $columns[] = '`imagePath` VARCHAR(255) DEFAULT NULL';
            }
            if ($hasDate) {
                $columns[] = '`date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP';
            }
            if ($hasUser) {
                $columns[] = '`userID` INT(11) NOT NULL';
            }
            if ($hasModule) {
                $columns[] = '`moduleID` INT(11) NOT NULL';
            }

            $sqlCreate = 'CREATE TABLE `' . $tableName . '` (' . implode(', ', $columns) . ')
                          ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
            $pdo->exec($sqlCreate);

            // 2. Add foreign keys if user/module are included
            if ($hasUser) {
                $pdo->exec(
                    'ALTER TABLE `' . $tableName . '`
                     ADD CONSTRAINT `' . $tableName . '_user_fk`
                     FOREIGN KEY (`userID`) REFERENCES `users`(`id`)
                     ON DELETE CASCADE ON UPDATE CASCADE'
                );
            }

            if ($hasModule) {
                $pdo->exec(
                    'ALTER TABLE `' . $tableName . '`
                     ADD CONSTRAINT `' . $tableName . '_module_fk`
                     FOREIGN KEY (`moduleID`) REFERENCES `modules`(`id`)
                     ON DELETE CASCADE ON UPDATE CASCADE'
                );
            }

            // 3. Save metadata to generated_page table
            $stmt = $pdo->prepare(
                'INSERT INTO generated_page
                    (name, slug, tableName, hasImage, hasDate, hasUser, hasModule)
                 VALUES
                    (:name, :slug, :tableName, :hasImage, :hasDate, :hasUser, :hasModule)'
            );
            $stmt->execute([
                ':name'      => $name,
                ':slug'      => $slug,
                ':tableName' => $tableName,
                ':hasImage'  => $hasImage,
                ':hasDate'   => $hasDate,
                ':hasUser'   => $hasUser,
                ':hasModule' => $hasModule,
            ]);

            $pageId = $pdo->lastInsertId();

            header('Location: dynamic_page.php?page_id=' . $pageId);
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Error creating page: ' . $e->getMessage();
        }
    }
}

$title = 'Create New Dynamic Page';

ob_start();
require '../templates/page_builder.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
