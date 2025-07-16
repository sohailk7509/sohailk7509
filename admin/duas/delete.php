<?php
require_once '../includes/db.php';
session_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $stmt = $db->prepare("DELETE FROM duas WHERE id = ?");
    $stmt->execute([$id]);
    
    $_SESSION['success'] = "دعا کامیابی سے حذف کر دی گئی ہے۔";
} catch(PDOException $e) {
    $_SESSION['error'] = "دعا حذف کرنے میں مسئلہ پیش آ گیا ہے۔";
}

header("Location: index.php");
exit; 