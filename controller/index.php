<?php
require '../includes/DatabaseConnection.php';

// get questions + join user/module
$sql = 'SELECT question.id,
               question.question_text,
               question.image_path,
               question.created_at,
               user.name AS user_name,
               module.name AS module_name
        FROM questions AS question
        JOIN users  AS user ON question.user_id   = user.id
        JOIN modules AS module ON question.module_id = module.id
        ORDER BY question.created_at DESC, question.id DESC';

$result     = $pdo->query($sql);
$questions  = $result->fetchAll();

$title = 'Home - Questions';

ob_start();
include '../templates/home.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
