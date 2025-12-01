<?php
require '../includes/DatabaseConnection.php';

$id      = $_GET['id'] ?? null;
$errors  = [];
$question_text = '';
$user_id       = '';
$module_id     = '';
$currentImage  = '';

$isEdit = $id && ctype_digit($id);

// load users / modules
$users   = $pdo->query('SELECT id, name FROM users ORDER BY name')->fetchAll();
$modules = $pdo->query('SELECT id, name FROM modules ORDER BY name')->fetchAll();

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT * FROM questions WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $q = $stmt->fetch();

    if (!$q) {
        header('Location: index.php');
        exit;
    }

    $question_text = $q['question_text'];
    $user_id       = $q['user_id'];
    $module_id     = $q['module_id'];
    $currentImage  = $q['image_path'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = trim($_POST['question_text'] ?? '');
    $user_id       = $_POST['user_id'] ?? '';
    $module_id     = $_POST['module_id'] ?? '';

    if ($question_text === '') {
        $errors[] = 'Question text is required.';
    }
    if ($user_id === '') {
        $errors[] = 'User is required.';
    }
    if ($module_id === '') {
        $errors[] = 'Module is required.';
    }

    $image_path = $currentImage;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp  = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $ext  = pathinfo($name, PATHINFO_EXTENSION);

        $newName = 'uploads/q_' . time() . '_' . random_int(1000, 9999) . '.' . $ext;

        // save file to uploads folder at root: ../uploads
        if (move_uploaded_file($tmp, '../' . $newName)) {
            if ($currentImage && file_exists('../' . $currentImage)) {
                @unlink('../' . $currentImage);
            }
            $image_path = $newName; // 'uploads/...'
        } else {
            $errors[] = 'Failed to upload image.';
        }
    }

    if (empty($errors)) {
        if ($isEdit) {
            $sql = 'UPDATE questions
                    SET question_text = :text,
                        user_id       = :user_id,
                        module_id     = :module_id,
                        image_path    = :image_path
                    WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':text'       => $question_text,
                ':user_id'    => $user_id,
                ':module_id'  => $module_id,
                ':image_path' => $image_path,
                ':id'         => $id,
            ]);
        } else {
            $sql = 'INSERT INTO questions
                        (question_text, user_id, module_id, image_path)
                    VALUES
                        (:text, :user_id, :module_id, :image_path)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':text'       => $question_text,
                ':user_id'    => $user_id,
                ':module_id'  => $module_id,
                ':image_path' => $image_path,
            ]);
        }

        // Run in /controller → redirect 'index.php' is enough
        header('Location: index.php');
        exit;
    }
}

$title = $isEdit ? 'Edit Question' : 'Add Question';

ob_start();
include '../templates/addquestion.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
