<?php
require_once '../config/db.php';

$id = $_GET['id'];

try {
    $stmt = $db->prepare("DELETE FROM bayanat WHERE id = ?");
    $stmt->execute([$id]);
    
    header("Location: ?page=bayanat");
    exit;
} catch(PDOException $e) {
    $error = 'ڈیٹابیس میں خرابی';
} 