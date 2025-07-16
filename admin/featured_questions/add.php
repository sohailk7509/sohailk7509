<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $image = '';

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array(strtolower($filetype), $allowed)) {
            $newname = uniqid() . '.' . $filetype;
            $upload_dir = '../../uploads/questions/';
            
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname)) {
                $image = $newname;
            }
        }
    }

    try {
        $stmt = $db->prepare("INSERT INTO featured_questions (title, question, answer, image, category, type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $question, $answer, $image, $category, $type]);
        header("Location: index.php?success=Question added successfully");
    } catch(PDOException $e) {
        header("Location: index.php?error=Failed to add question");
    }
    exit();
} 