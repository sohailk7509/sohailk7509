<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    } else {
        // Password validation
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
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($errors)) {
        try {
            $stmt = $db->prepare("SELECT id FROM admin WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $errors[] = "Username already exists";
            } else {
                $stmt = $db->prepare("INSERT INTO admin (username, password, created_at) VALUES (?, ?, NOW())");
                $stmt->execute([$username, $password]);
                
                // Set success message
                $_SESSION['success'] = "User account created successfully";
                
                // Redirect to users list page
                header("Location: ../users/index.php");
                exit;
            }
        } catch(PDOException $e) {
            $errors[] = "Database error occurred";
            error_log($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamia Banuri - Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        .login-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            background-color: #b3997d;
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
            font-size: 1.5rem;
            padding: 10px;
            border-radius: 8px;
        }
        .form-control {
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #b3997d;
            box-shadow: 0 0 0 0.2rem rgba(179, 153, 125, 0.25);
        }
        .form-label {
            color: #3c2f1b;
            font-weight: 500;
        }
        .btn-brown {
            background: #b3997d;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            width: 100%;
            margin-top: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-brown:hover {
            background: #3c2f1b;
            color: #fff;
            transform: translateY(-1px);
        }
        .alert {
            border-radius: 8px;
        }
        .alert ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .login-link {
            color: #b3997d;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .login-link:hover {
            color: #3c2f1b;
        }
        .password-requirements {
            font-size: 0.85rem;
            padding-left: 20px;
            margin-top: 5px;
            color: #666;
        }
        
        .password-requirements li {
            margin-bottom: 2px;
            list-style: none;
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
        .toggle-password {
            border-color: #e0e0e0;
            color: #666;
        }
        .toggle-password:hover {
            background-color: #f8f9fa;
            border-color: #b3997d;
            color: #3c2f1b;
        }
        .input-group .form-control {
            border-right: none;
        }
        .input-group .btn {
            border-left: none;
            padding: 12px 16px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <img src="https://www.banuri.edu.pk/assets/svg/logo.svg" alt="Jamia Banuri Logo">
        </div>
        <h2>Create New Account</h2>
        
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
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
                       placeholder="Enter your username" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" 
                           placeholder="Enter your password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="confirm_password" class="form-control" 
                           placeholder="Confirm your password" required>
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
            
            <button type="submit" class="btn btn-brown">Create Account</button>
            
            <div class="text-center mt-4">
                <a href="login.php" class="login-link">Already have an account? Login</a>
            </div>
        </form>
    </div>
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
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmInput = document.querySelector('input[name="confirm_password"]');

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
        
        // Check each requirement
        for (const [key, requirement] of Object.entries(requirements)) {
            updateRequirement(requirement, requirement.regex.test(password));
        }
    });

    // Check if passwords match
    confirmInput.addEventListener('input', function() {
        const isMatch = this.value === passwordInput.value;
        this.style.borderColor = isMatch ? '#198754' : '#dc3545';
    });
    </script>
</body>
</html> 