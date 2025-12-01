<?php
require '../includes/DatabaseConnection.php';

// case dynamic page
if (isset($_GET['page_id'], $_GET['id']) && ctype_digit($_GET['page_id']) && ctype_digit($_GET['id'])) {
    $page_id = $_GET['page_id'];
    $id      = $_GET['id'];

    $stmt = $pdo->prepare('SELECT * FROM generated_page WHERE id = :id');
    $stmt->execute([':id' => $page_id]);
    $page = $stmt->fetch();

    if ($page) {
        $table_name = $page['table_name'];

        if ($page['has_image']) {
            $stmt = $pdo->prepare(
                'SELECT image_path FROM `' . $table_name . '` WHERE id = :id'
            );
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row && !empty($row['image_path']) &&
                file_exists('../' . $row['image_path'])) {
                @unlink('../' . $row['image_path']);
            }
        }

        $stmt = $pdo->prepare('DELETE FROM `' . $table_name . '` WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    header('Location: dynamic_page.php?page_id=' . $page_id);
    exit;
}

// case static questions
if (isset($_GET['table'], $_GET['id']) && $_GET['table'] === 'questions' && ctype_digit($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare('SELECT image_path FROM questions WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if ($row && !empty($row['image_path']) &&
        file_exists('../' . $row['image_path'])) {
        @unlink('../' . $row['image_path']);
    }

    $stmt = $pdo->prepare('DELETE FROM questions WHERE id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: index.php');
    exit;
}

header('Location: index.php');
exit;
