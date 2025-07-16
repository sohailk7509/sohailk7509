<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $stmt = $db->prepare("DELETE FROM admin_users WHERE id = ?");
    $stmt->execute([$id]);
    
    $_SESSION['success'] = "یوزر کامیابی سے حذف کر دیا گیا ہے۔";
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $_SESSION['error'] = "یوزر کو حذف کرنے میں مسئلہ پیش آ گیا۔";
}

header("Location: index.php");
exit; 