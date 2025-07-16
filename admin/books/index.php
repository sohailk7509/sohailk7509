<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Get all books
$stmt = $db->query("SELECT * FROM books ORDER BY created_at DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                            <h3 class="card-title">کتابیں</h3>
                            <a href="add.php" class="btn btn-primary float-end">نئی کتاب شامل کریں</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>عنوان</th>
                                            <th>مصنف</th>
                                            <th>زمرہ</th>
                                            <th>PDF فائل</th>
                                            <th>تاریخ</th>
                                            <th>ایکشن</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($books as $book): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                                            <td><?php echo htmlspecialchars($book['author']); ?></td>
                                            <td><?php echo htmlspecialchars($book['category']); ?></td>
                                            <td>
                                                <?php if(!empty($book['pdf_url'])): ?>
                                                    <a href="../../<?php echo htmlspecialchars($book['pdf_url']); ?>" target="_blank" class="btn btn-sm btn-success">
                                                        <i class="fas fa-file-pdf"></i> دیکھیں
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">PDF نہیں ہے</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($book['created_at']); ?></td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-info">ترمیم</a>
                                                <a href="delete.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">حذف</a>
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
</div>

</body>
</html> 