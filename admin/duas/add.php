<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $arabic_text = $_POST['arabic_text'];
    $translation = $_POST['translation'];
    $reference = $_POST['reference'];
    $slug = createSlug($title);
    $status = 1; // Set as active by default

    try {
        // Check if any active dua exists for this category
        $check_stmt = $db->prepare("SELECT id FROM duas WHERE category = ? AND status = 1");
        $check_stmt->execute([$category]);
        $existing_dua = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_dua) {
            // Deactivate old dua
            $update_stmt = $db->prepare("UPDATE duas SET status = 0 WHERE category = ?");
            $update_stmt->execute([$category]);
        }

        // Insert new dua
        $stmt = $db->prepare("INSERT INTO duas (title, slug, category, arabic_text, translation, reference, status, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $slug, $category, $arabic_text, $translation, $reference, $status]);
        
        $_SESSION['success'] = "دعا کامیابی سے شامل کر دی گئی ہے۔";
        header("Location: index.php");
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "دعا شامل کرنے میں مسئلہ پیش آ گیا ہے۔ Error: " . $e->getMessage();
    }
}

// Get all categories
try {
    $stmt = $db->query("SELECT * FROM dua_categories ORDER BY name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $_SESSION['error'] = "قسمیں حاصل کرنے میں مسئلہ پیش آ گیا۔";
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نئی دعا شامل کریں</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
</head>
<body>
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

                        <?php if(isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?php 
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">نئی دعا شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">عنوان</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">قسم</label>
                                        <select name="category" class="form-control" required>
                                            <?php foreach($categories as $category): ?>
                                                <option value="<?php echo $category['slug']; ?>">
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">عربی متن</label>
                                        <textarea name="arabic_text" class="form-control" rows="3" dir="rtl" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ترجمہ</label>
                                        <textarea name="translation" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">حوالہ</label>
                                        <input type="text" name="reference" class="form-control" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
