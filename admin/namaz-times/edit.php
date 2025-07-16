<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get prayer time details
$stmt = $db->prepare("SELECT * FROM prayer_times WHERE id = ?");
$stmt->execute([$id]);
$time = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$time) {
    header('Location: index.php');
    exit;
}

// Update prayer time
if(isset($_POST['submit'])) {
    $city = $_POST['city'];
    $month = $_POST['month'];
    $fajr = $_POST['fajr'];
    $sunrise = $_POST['sunrise'];
    $dhuhr = $_POST['dhuhr'];
    $asr = $_POST['asr'];
    $maghrib = $_POST['maghrib'];
    $isha = $_POST['isha'];

    try {
        $stmt = $db->prepare("UPDATE prayer_times SET city = ?, month = ?, fajr = ?, sunrise = ?, dhuhr = ?, asr = ?, maghrib = ?, isha = ? WHERE id = ?");
        $stmt->execute([$city, $month, $fajr, $sunrise, $dhuhr, $asr, $maghrib, $isha, $id]);
        $_SESSION['success'] = "نماز کے اوقات کامیابی سے اپ ڈیٹ ہو گئے";
        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prayer Times</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <!-- Form with prefilled values -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/admin-script.js"></script>
</body>
</html> 