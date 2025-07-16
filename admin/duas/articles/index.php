<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Handle Delete Request
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit();
}

// Get all articles
$stmt = $db->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $image = '';

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array(strtolower($filetype), $allowed)) {
            $newname = uniqid() . '.' . $filetype;
            $upload_dir = '../../uploads/articles/';
            
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
        header("Location: index.php?success=1");
    } catch(PDOException $e) {
        header("Location: index.php?error=1");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fs-4">Articles Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                        <i class="fas fa-plus"></i> Add New Article
                    </button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($articles as $article): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($article['title']); ?></td>
                                    <td><?php echo htmlspecialchars($article['category']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $article['status'] == 'published' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($article['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('Y-m-d', strtotime($article['created_at'])); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

    <!-- Add Article Modal -->
    <div class="modal fade" id="addArticleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="add_article.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" id="editor"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" required>
                                        <option value="Islamic">Islamic</option>
                                        <option value="Educational">Educational</option>
                                        <option value="News">News</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 300,
            removeButtons: 'Image',
            language: 'ar'
        });
    </script>
</body>
</html> 