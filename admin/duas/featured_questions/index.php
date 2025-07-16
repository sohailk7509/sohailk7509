<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Get all featured questions
$stmt = $db->query("SELECT * FROM featured_questions ORDER BY created_at DESC");
$questions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured Questions Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fs-4">Featured Questions Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                        <i class="fas fa-plus"></i> Add New Question
                    </button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($questions as $question): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($question['title']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $question['type'] == 'featured' ? 'success' : 'info'; ?>">
                                            <?php echo ucfirst($question['type']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($question['category']); ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($question['created_at'])); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $question['id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $question['id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="delete.php?id=<?php echo $question['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
                    <h5 class="modal-title">Add New Featured Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="add.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Question</label>
                            <textarea name="question" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Answer</label>
                            <textarea name="answer" class="form-control" rows="5" required></textarea>
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
                                        <option value="Social">Social</option>
                                        <option value="Family">Family</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="featured">Featured</option>
                                        <option value="new">New</option>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 