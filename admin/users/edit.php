<?php
require_once '../includes/session.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
checkLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get user details
try {
    $stmt = $db->prepare("SELECT * FROM admin WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$user) {
        $_SESSION['error'] = "User not found";
        header("Location: index.php");
        exit;
    }
} catch(PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['error'] = "Error fetching user details";
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    // Password validation if password is being changed
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must contain at least one uppercase letter";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Password must contain at least one number";
        }
        if (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
            $errors[] = "Password must contain at least one special character";
        }
    }
    
    // Check if username exists (excluding current user)
    $stmt = $db->prepare("SELECT id FROM admin WHERE username = ? AND id != ?");
    $stmt->execute([$username, $id]);
    if ($stmt->fetch()) {
        $errors[] = "Username already exists";
    }
    
    if (empty($errors)) {
        try {
            if (!empty($password)) {
                // Update with new password
                $stmt = $db->prepare("UPDATE admin SET username = ?, password = ? WHERE id = ?");
                $stmt->execute([$username, $password, $id]);
            } else {
                // Update without changing password
                $stmt = $db->prepare("UPDATE admin SET username = ? WHERE id = ?");
                $stmt->execute([$username, $id]);
            }
            
            $_SESSION['success'] = "User updated successfully";
            header("Location: index.php");
            exit;
            
        } catch(PDOException $e) {
            error_log($e->getMessage());
            $errors[] = "Error updating user";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Jamia Banuri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <style>
        .password-requirements {
            font-size: 0.85rem;
            padding-left: 20px;
            margin-top: 5px;
            color: #666;
            list-style: none;
        }
        
        .password-requirements li {
            margin-bottom: 2px;
            position: relative;
            padding-left: 25px;
        }
        
        .password-requirements li i {
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        .requirement-met {
            color: #198754;
        }
        
        .requirement-not-met {
            color: #dc3545;
        }
    </style>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Edit User</h3>
                            </div>
                            <div class="card-body">
                                <?php if(!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <?php foreach($errors as $error): ?>
                                                <li><?php echo $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">New Password (leave blank to keep current)</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password">
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted">
                                            Password must:
                                            <ul class="password-requirements">
                                                <li id="length-check">
                                                    <i class="fas fa-times text-danger"></i>
                                                    Be at least 8 characters long
                                                </li>
                                                <li id="uppercase-check">
                                                    <i class="fas fa-times text-danger"></i>
                                                    Contain at least one uppercase letter
                                                </li>
                                                <li id="number-check">
                                                    <i class="fas fa-times text-danger"></i>
                                                    Contain at least one number
                                                </li>
                                                <li id="special-check">
                                                    <i class="fas fa-times text-danger"></i>
                                                    Contain at least one special character
                                                </li>
                                            </ul>
                                        </small>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Save Changes
                                        </button>
                                        <a href="index.php" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Back to List
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Password validation script
    const passwordInput = document.querySelector('#password');
    const requirements = {
        length: { regex: /.{8,}/, element: document.getElementById('length-check') },
        uppercase: { regex: /[A-Z]/, element: document.getElementById('uppercase-check') },
        number: { regex: /[0-9]/, element: document.getElementById('number-check') },
        special: { regex: /[!@#$%^&*(),.?":{}|<>]/, element: document.getElementById('special-check') }
    };

    function updateRequirement(requirement, isValid) {
        const icon = requirement.element.querySelector('i');
        if (isValid) {
            icon.className = 'fas fa-check text-success';
            requirement.element.classList.add('requirement-met');
            requirement.element.classList.remove('requirement-not-met');
        } else {
            icon.className = 'fas fa-times text-danger';
            requirement.element.classList.add('requirement-not-met');
            requirement.element.classList.remove('requirement-met');
        }
    }

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        if (password.length > 0) {
            document.querySelector('.password-requirements').style.display = 'block';
            for (const [key, requirement] of Object.entries(requirements)) {
                updateRequirement(requirement, requirement.regex.test(password));
            }
        } else {
            document.querySelector('.password-requirements').style.display = 'none';
        }
    });

    // Initially hide requirements
    document.querySelector('.password-requirements').style.display = 'none';
    </script>
</body>
</html> 