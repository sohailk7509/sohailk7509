<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Check if form is submitted
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    try {
        $stmt = $db->prepare("INSERT INTO bayanat (title, content, author, category) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $author, $category]);
        $_SESSION['success'] = "بیّنات کامیابی سے شامل کر دیا گیا";
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

// Get all bayanat
$stmt = $db->query("SELECT * FROM bayanat ORDER BY created_at DESC");
$bayanat = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add this article content

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
                            <h3 class="card-title">نیا بیّنات شامل کریں</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>مصنف</label>
                                            <input type="text" name="author" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>زمرہ</label>
                                            <select name="category" class="form-control" required>
                                                <option value="hazrat-banuri">حضرت بنوری</option>
                                                <option value="ramadan">رمضان</option>
                                                <option value="internet">انٹرنیٹ</option>
                                                <option value="smartphone">اسمارٹ فون</option>
                                                <option value="sunnat">سنت</option>
                                                <option value="madaris">مدارس</option>
                                                <option value="ulama">علماء</option>
                                                <option value="islam">اسلام</option>
                                                <option value="other">دیگر</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>متن</label>
                                            <textarea name="content" id="content" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-3">محفوظ کریں</button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">تمام بیّنات</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>مصنف</th>
                                        <th>زمرہ</th>
                                        <th>تاریخ</th>
                                        <th>ایکشن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($bayanat as $bayan): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($bayan['title']); ?></td>
                                        <td><?php echo htmlspecialchars($bayan['author']); ?></td>
                                        <td><?php echo htmlspecialchars($bayan['category']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($bayan['created_at'])); ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $bayan['id']; ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $bayan['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

