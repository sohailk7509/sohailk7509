<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    try {
        $stmt = $db->prepare("INSERT INTO questions (title, content, category, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $category, $status]);
        header("Location: index.php?success=1");
    } catch(PDOException $e) {
        header("Location: index.php?error=1");
    }
    exit();
} 