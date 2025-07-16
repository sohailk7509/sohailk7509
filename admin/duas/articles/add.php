<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    try {
        // Insert article into database
        $stmt = $db->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        
        // Redirect with success message
        header("Location: index.php?success=Article added successfully");
        exit();
    } catch(PDOException $e) {
        // Log error
        error_log("Database Error: " . $e->getMessage());
        
        // Redirect with error message
        header("Location: index.php?error=Failed to add article");
        exit();
    }
}

// If not POST request, redirect back
header("Location: index.php");
exit(); 