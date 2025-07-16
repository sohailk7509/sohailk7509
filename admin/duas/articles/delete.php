<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        // Delete the article
        $stmt = $db->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: index.php?success=Article deleted successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: index.php?error=Failed to delete article");
    }
    exit();
}

header("Location: index.php");
exit(); 