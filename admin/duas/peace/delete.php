<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        $stmt = $db->prepare("DELETE FROM peace_items WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: index.php?success=Item deleted successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: index.php?error=Failed to delete item");
    }
    exit();
}

header("Location: index.php"); 