<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    try {
        // Update the question
        $stmt = $db->prepare("UPDATE questions SET title = ?, content = ?, category = ?, status = ? WHERE id = ?");
        $stmt->execute([$title, $content, $category, $status, $id]);

        // Redirect with success message
        header("Location: index.php?success=Question updated successfully");
        exit();
    } catch(PDOException $e) {
        // Redirect with error message
        header("Location: index.php?error=Failed to update question");
        exit();
    }
} else {
    // If not POST request, redirect back to questions page
    header("Location: index.php");
    exit();
}
