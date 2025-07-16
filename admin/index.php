<?php
require_once 'includes/session.php';
require_once 'config/db.php';
checkLogin();

// Get counts for dashboard
$questionCount = $db->query("SELECT COUNT(*) FROM questions")->fetchColumn();
$articleCount = $db->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$newsCount = $db->query("SELECT COUNT(*) FROM news")->fetchColumn();
$userCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Get recent questions
$recentQuestions = $db->query("SELECT * FROM questions ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/admin-style.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include 'includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <!-- Stats Cards -->
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3><?php echo $questionCount; ?></h3>
                                <p class="fs-5">Questions</p>
                            </div>
                            <i class="fas fa-question-circle fs-1 text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3><?php echo $articleCount; ?></h3>
                                <p class="fs-5">Articles</p>
                            </div>
                            <i class="fas fa-book fs-1 text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3><?php echo $newsCount; ?></h3>
                                <p class="fs-5">News</p>
                            </div>
                            <i class="fas fa-newspaper fs-1 text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3><?php echo $userCount; ?></h3>
                                <p class="fs-5">Users</p>
                            </div>
                            <i class="fas fa-users fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Questions -->
                <div class="row my-5">
                    <div class="col">
                        <h3 class="fs-4 mb-3">Recent Questions</h3>
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
                                        <?php foreach ($recentQuestions as $question): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($question['title']); ?></td>
                                            <td><?php echo htmlspecialchars($question['category']); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $question['status'] == 'published' ? 'success' : 'warning'; ?>">
                                                    <?php echo ucfirst($question['status']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('Y-m-d', strtotime($question['created_at'])); ?></td>
                                            <td>
                                                <a href="questions/edit.php?id=<?php echo $question['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger" onclick="deleteQuestion(<?php echo $question['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin-script.js"></script>
</body>
</html> 