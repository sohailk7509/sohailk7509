<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    // Get current user
    $stmt = $db->prepare("SELECT username, status FROM admin WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$user) {
        $_SESSION['error'] = "User not found";
        header("Location: index.php");
        exit;
    }
    
    // Don't allow toggling admin user
    if($user['username'] === 'admin') {
        $_SESSION['error'] = "Cannot modify admin user status";
        header("Location: index.php");
        exit;
    }
    
    // Toggle status
    $newStatus = $user['status'] ? 0 : 1;
    $stmt = $db->prepare("UPDATE admin SET status = ? WHERE id = ?");
    $stmt->execute([$newStatus, $id]);
    
    $_SESSION['success'] = "User status updated successfully";
    
} catch(PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['error'] = "Error updating user status";
}

header("Location: index.php");
exit; 