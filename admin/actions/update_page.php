<?php
require_once '../includes/auth_check.php';
require_once '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page_id = $_POST['page_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    
    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE pages SET title = ?, content = ?, status = ?, updated_at = NOW() WHERE page_id = ?");
    $stmt->bind_param("ssis", $title, $content, $status, $page_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    
    $stmt->close();
} 