<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $image = '';

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array(strtolower($filetype), $allowed)) {
            // Generate unique filename
            $newname = uniqid() . '.' . $filetype;
            $upload_dir = '../../uploads/news/';
            
            // Create directory if it doesn't exist
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Move uploaded file
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname)) {
                $image = $newname;
            }
        }
    }

    try {
        // Insert news into database
        $stmt = $db->prepare("INSERT INTO news (title, content, image, day, month) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $content, $image, $day, $month]);
        
        // Redirect with success message
        header("Location: index.php?success=News added successfully");
    } catch(PDOException $e) {
        // Log error
        error_log("Database Error: " . $e->getMessage());
        
        // Delete uploaded image if database insert failed
        if($image && file_exists('../../uploads/news/' . $image)) {
            unlink('../../uploads/news/' . $image);
        }
        
        // Redirect with error message
        header("Location: index.php?error=Failed to add news");
    }
    exit();
}

// If not POST request, redirect back
header("Location: index.php");
exit(); 