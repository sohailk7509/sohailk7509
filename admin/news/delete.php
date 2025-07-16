<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Get image filename before deleting record
        $stmt = $db->prepare("SELECT image FROM news WHERE id = ?");
        $stmt->execute([$id]);
        $news = $stmt->fetch();
        
        // Delete the record
        $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$id]);
        
        // Delete associated image file
        if($news && $news['image']) {
            $image_path = '../../uploads/news/' . $news['image'];
            if(file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        header("Location: index.php?success=News deleted successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: index.php?error=Failed to delete news");
    }
    exit();
}

header("Location: index.php");
exit(); 