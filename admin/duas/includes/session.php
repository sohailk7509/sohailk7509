<?php
session_start();
function checkLogin() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../admin/auth/login.php");
        exit();
    }
}
?> 