<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $category = $_POST['category'];

    try {
        $stmt = $db->prepare("INSERT INTO speeches (title, content, status, category) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $status, $category]);
        
        header("Location: index.php?success=Speech added successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        
        header("Location: index.php?error=Failed to add speech");
    }
    exit();
}

header("Location: index.php");
exit(); 