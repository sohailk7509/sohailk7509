<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $embed_code = $_POST['embed_code'];
    $status = $_POST['status'];

    try {
        $stmt = $db->prepare("INSERT INTO peace_items (title, description, embed_code, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $embed_code, $status]);
        
        header("Location: index.php?success=Item added successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: index.php?error=Failed to add item");
    }
    exit();
}

header("Location: index.php");
exit(); 