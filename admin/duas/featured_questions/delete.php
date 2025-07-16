<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $db->prepare("DELETE FROM featured_questions WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php?success=Question deleted successfully");
    } catch(PDOException $e) {
        header("Location: index.php?error=Failed to delete question");
    }
    exit();
}

header("Location: index.php");
exit(); 