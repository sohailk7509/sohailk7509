<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        // Delete the speech
        $stmt = $db->prepare("DELETE FROM speeches WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: index.php?success=Speech deleted successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: index.php?error=Failed to delete speech");
    }
    exit();
}

header("Location: index.php");
exit(); 