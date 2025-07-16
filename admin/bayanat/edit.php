<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $pdf_url = $_POST['pdf_url'];
    
    try {
        $stmt = $db->prepare("UPDATE bayanat SET title = ?, author = ?, content = ?, pdf_url = ? WHERE id = ?");
        $stmt->execute([$title, $author, $content, $pdf_url, $id]);
        
        header("Location: ?page=bayanat");
        exit;
    } catch(PDOException $e) {
        $error = 'ڈیٹابیس میں خرابی';
    }
}

// Get article details
$stmt = $db->prepare("SELECT * FROM bayanat WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">مضمون میں ترمیم</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>عنوان</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($article['title']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>مصنف</label>
                                    <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($article['author']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>مضمون</label>
                                    <textarea name="content" class="form-control" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>پی ڈی ایف لنک</label>
                                    <input type="text" name="pdf_url" class="form-control" value="<?php echo htmlspecialchars($article['pdf_url']); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">تبدیلیاں محفوظ کریں</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('content');
</script>
