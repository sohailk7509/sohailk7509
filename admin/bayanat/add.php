<?php
require_once '../config/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $pdf_url = $_POST['pdf_url'];
    
    try {
        $stmt = $db->prepare("INSERT INTO bayanat (title, author, content, pdf_url, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $author, $content, $pdf_url]);
        
        header("Location: ?page=bayanat");
        exit;
    } catch(PDOException $e) {
        $error = 'ڈیٹابیس میں خرابی';
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نیا مضمون شامل کریں</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>مصنف</label>
                            <input type="text" name="author" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>مضمون</label>
                            <textarea name="content" class="form-control" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>پی ڈی ایف لنک</label>
                            <input type="text" name="pdf_url" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">محفوظ کریں</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 