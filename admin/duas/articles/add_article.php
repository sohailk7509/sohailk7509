<?php

require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $image = '';

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array(strtolower($filetype), $allowed)) {
            $newname = uniqid() . '.' . $filetype;
            $upload_dir = '../../uploads/articles/';
            
            // Create directory if it doesn't exist
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname)) {
                $image = $newname;
            }
        }
    }

    try {
        $stmt = $db->prepare("INSERT INTO articles (title, content, image, category, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $content, $image, $category, $status]);
        
        header("Location: index.php?success=Article added successfully");
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        
        // Delete uploaded image if database insert failed
        if($image && file_exists('../../uploads/articles/' . $image)) {
            unlink('../../uploads/articles/' . $image);
        }
        
        header("Location: index.php?error=Failed to add article");
    }
    exit();
}

header("Location: index.php");
exit(); 