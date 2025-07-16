<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $page_id = $_POST['page_id'];
    
    $sql = "INSERT INTO pages (page_id, title, content, status) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    
    if ($stmt->execute([$page_id, $title, $content, $status])) {
        $_SESSION['success'] = "Page added successfully";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = "Error adding page";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Page</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label>Page ID</label>
                            <input type="text" class="form-control" name="page_id" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Content</label>
                            <textarea id="pageContent" name="content" class="form-control editor" rows="20"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    CKEDITOR.replace('pageContent', {
        contentsLangDirection: 'rtl',
        height: 500,
        removeButtons: 'Save',
        allowedContent: true
    });
});
</script> 