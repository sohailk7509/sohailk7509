<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Handle Delete Request
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit();
}

// Get all questions
$stmt = $db->query("SELECT * FROM questions ORDER BY created_at DESC");
$questions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Management - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <!-- jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Then Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fs-4">Questions Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                        <i class="fas fa-plus"></i> Add New Question
                    </button>
                </div>

                <!-- Questions Table -->
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($questions as $question): ?>
                                <tr>
                                    <td><?php echo $question['id']; ?></td>
                                    <td><?php echo htmlspecialchars($question['title']); ?></td>
                                    <td><?php echo htmlspecialchars($question['category']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $question['status'] == 'published' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($question['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('Y-m-d', strtotime($question['created_at'])); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewQuestionModal<?php echo $question['id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editQuestionModal<?php echo $question['id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete=<?php echo $question['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this question?')">
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

    <!-- Add Question Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="add_question.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <option value="Salah">Salah</option>
                                        <option value="Zakat">Zakat</option>
                                        <option value="Fasting">Fasting</option>
                                        <option value="Hajj">Hajj</option>
                                        <option value="Other">Other</option>
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
                        <button type="submit" class="btn btn-primary">Save Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Question Modals -->
    <?php foreach($questions as $question): ?>
    <div class="modal fade" id="viewQuestionModal<?php echo $question['id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h4><?php echo htmlspecialchars($question['title']); ?></h4>
                    <p class="text-muted">Category: <?php echo htmlspecialchars($question['category']); ?></p>
                    <div class="content mt-3">
                        <?php echo nl2br(htmlspecialchars($question['content'])); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Question Modals -->
    <div class="modal fade" id="editQuestionModal<?php echo $question['id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="edit_question.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($question['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($question['content']); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" required>
                                        <option value="Salah" <?php echo $question['category'] == 'Salah' ? 'selected' : ''; ?>>Salah</option>
                                        <option value="Zakat" <?php echo $question['category'] == 'Zakat' ? 'selected' : ''; ?>>Zakat</option>
                                        <option value="Fasting" <?php echo $question['category'] == 'Fasting' ? 'selected' : ''; ?>>Fasting</option>
                                        <option value="Hajj" <?php echo $question['category'] == 'Hajj' ? 'selected' : ''; ?>>Hajj</option>
                                        <option value="Other" <?php echo $question['category'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="draft" <?php echo $question['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                        <option value="published" <?php echo $question['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script>
        // Initialize Bootstrap modals
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('addQuestionModal'), {
                keyboard: false
            });
            
            // Initialize view and edit modals
            <?php foreach($questions as $question): ?>
            new bootstrap.Modal(document.getElementById('viewQuestionModal<?php echo $question['id']; ?>'), {
                keyboard: false
            });
            new bootstrap.Modal(document.getElementById('editQuestionModal<?php echo $question['id']; ?>'), {
                keyboard: false
            });
            <?php endforeach; ?>
        });
    </script>
</body>
</html> 