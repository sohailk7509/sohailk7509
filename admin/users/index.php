<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

// Get all users
try {
    $stmt = $db->query("SELECT * FROM admin ORDER BY created_at DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $users = [];
}
?>

<?php require_once '../includes/header.php'  ?>
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
                        <?php if(isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?php 
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Manage Users</h3>
                                <a href="../auth/signup.php" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add New User
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($users as $user): ?>
                                                <tr>
                                                    <td><?php echo $user['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                                                    <td>
                                                        <?php if($user['username'] !== 'admin'): ?>
                                                            <a href="toggle-status.php?id=<?php echo $user['id']; ?>" 
                                                               class="btn btn-sm <?php echo $user['status'] ? 'btn-success' : 'btn-danger'; ?>"
                                                               onclick="return confirm('Are you sure you want to <?php echo $user['status'] ? 'deactivate' : 'activate'; ?> this user?');">
                                                                <i class="fas <?php echo $user['status'] ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                                                <?php echo $user['status'] ? 'Active' : 'Inactive'; ?>
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="badge bg-success">Active</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit.php?id=<?php echo $user['id']; ?>" 
                                                           class="btn btn-info btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php if($user['username'] !== 'admin'): ?>
                                                            <a href="delete.php?id=<?php echo $user['id']; ?>" 
                                                               class="btn btn-danger btn-sm"
                                                               onclick="return confirm('Are you sure you want to delete this user?');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        <?php endif; ?>
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