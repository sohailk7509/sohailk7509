<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get book details
try {
    $stmt = $db->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$book) {
        $_SESSION['error'] = "کتاب نہیں ملی۔";
        header("Location: index.php");
        exit;
    }
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $_SESSION['error'] = "کتاب کی تفصیلات حاصل کرنے میں مسئلہ پیش آ گیا۔";
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $status = isset($_POST['status']) ? 1 : 0;  // Default to 0 if not checked
    
    try {
        // Handle file upload if new file is selected
        if(!empty($_FILES['pdf_file']['name'])) {
            $pdf_file = $_FILES['pdf_file'];
            $upload_dir = "../../uploads/books/";
            $file_name = time() . "_" . basename($pdf_file['name']);
            $target_path = $upload_dir . $file_name;
            
            // Delete old file if exists
            if(!empty($book['pdf_path'])) {
                @unlink("../../" . $book['pdf_path']);
            }
            
            if(move_uploaded_file($pdf_file['tmp_name'], $target_path)) {
                $pdf_path = "uploads/books/" . $file_name;
            } else {
                throw new Exception("فائل اپلوڈ کرنے میں مسئلہ پیش آ گیا۔");
            }
        } else {
            $pdf_path = $book['pdf_path'];
        }
        
        // Update book
        $stmt = $db->prepare("UPDATE books SET title = ?, author = ?, content = ?, category = ?, pdf_path = ?, status = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$title, $author, $description, $category, $pdf_path, $status, $id]);
        
        $_SESSION['success'] = "کتاب کامیابی سے اپ ڈیٹ کر دی گئی ہے۔";
        header("Location: index.php");
        exit;
        
    } catch(Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}
?>

<?php require_once '../includes/header.php'  ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?php 
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">کتاب میں ترمیم کریں</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">عنوان</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">مصنف</label>
                                        <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">تفصیل</label>
                                        <textarea name="description" class="form-control" rows="3"><?php echo isset($book['content']) ? htmlspecialchars($book['content']) : ''; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">قسم</label>
                                        <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($book['category']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">PDF فائل</label>
                                        <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                                        <?php if(!empty($book['pdf_path'])): ?>
                                            <small class="text-muted">موجودہ فائل: <?php echo basename($book['pdf_path']); ?></small>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="status" class="form-check-input" id="status" 
                                                   <?php echo (isset($book['status']) && $book['status'] == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">فعال</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">محفوظ کریں</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html> 