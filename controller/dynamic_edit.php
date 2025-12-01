<?php
require '../includes/DatabaseConnection.php';

$page_id = $_GET['page_id'] ?? null;
$id      = $_GET['id'] ?? null;

if (!$page_id || !ctype_digit($page_id)) {
    header('Location: /index.php');
    exit;
}

// load page
$stmt = $pdo->prepare('SELECT * FROM generated_page WHERE id = :id');
$stmt->execute([':id' => $page_id]);
$page = $stmt->fetch();

if (!$page) {
    header('Location: /index.php');
    exit;
}

// load fields
$stmt = $pdo->prepare('SELECT * FROM generated_page_field WHERE page_id = :page_id ORDER BY position');
$stmt->execute([':page_id' => $page_id]);
$fields = $stmt->fetchAll();

$table_name = $page['table_name'];

$errors = [];
$data = [];
$currentImage = '';

$isEdit = $id && ctype_digit($id);

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT * FROM `' . $table_name . '` WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch();

    if (!$record) {
        header('Location: /dynamic_page.php?page_id=' . $page_id);
        exit;
    }

    if ($page['has_image']) {
        $currentImage = $record['image_path'];
    }
    foreach ($fields as $f) {
        $fn = $f['field_name'];
        $data[$fn] = $record[$fn];
    }
} else {
    foreach ($fields as $f) {
        $data[$f['field_name']] = '';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $f) {
        $fn = $f['field_name'];
        $data[$fn] = trim($_POST[$fn] ?? '');
        if ($f['is_required'] && $data[$fn] === '') {
            $errors[] = $f['label'] . ' is required.';
        }
    }

    $image_path = $currentImage;

    if ($page['has_image'] && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp  = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $ext  = pathinfo($name, PATHINFO_EXTENSION);

        $newName = 'uploads/dyn_' . time() . '_' . random_int(1000, 9999) . '.' . $ext;

        if (move_uploaded_file($tmp, '../' . $newName)) {
            if ($currentImage && file_exists('../' . $currentImage)) {
                @unlink('../' . $currentImage);
            }
            $image_path = $newName;
        } else {
            $errors[] = 'Failed to upload image.';
        }
    }

    if (empty($errors)) {
        if ($isEdit) {
            $setParts = [];
            $params = [':id' => $id];

            foreach ($fields as $f) {
                $fn = $f['field_name'];
                $setParts[] = "`$fn` = :$fn";
                $params[":$fn"] = $data[$fn];
            }

            if ($page['has_image']) {
                $setParts[] = 'image_path = :image_path';
                $params[':image_path'] = $image_path;
            }

            $sql = 'UPDATE `' . $table_name . '` SET ' . implode(', ', $setParts) . ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        } else {
            $cols = [];
            $placeholders = [];
            $params = [];

            foreach ($fields as $f) {
                $fn = $f['field_name'];
                $cols[] = "`$fn`";
                $placeholders[] = ":$fn";
                $params[":$fn"] = $data[$fn];
            }

            if ($page['has_image']) {
                $cols[] = 'image_path';
                $placeholders[] = ':image_path';
                $params[':image_path'] = $image_path;
            }

            $sql = 'INSERT INTO `' . $table_name . '` (' . implode(',', $cols) . ')
                    VALUES (' . implode(',', $placeholders) . ')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }

        header('Location: /dynamic_page.php?page_id=' . $page_id);
        exit;
    }
}

$title = ($isEdit ? 'Edit ' : 'Add ') . $page['name'];

ob_start();
include '../templates/dynamic_form.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
