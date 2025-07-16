<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $db->prepare("DELETE FROM prayer_times WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "نماز کے اوقات کامیابی سے حذف ہو گئے";
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

header('Location: index.php');
exit; 