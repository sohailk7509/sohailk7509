<?php
require_once '../../includes/session.php';
require_once '../../config/db.php';
checkLogin();

if(isset($_POST['submit'])) {
    $city = $_POST['city'];
    $month = $_POST['month'];
    $date = $_POST['date'];
    $fajr = $_POST['fajr'];
    $sunrise = $_POST['sunrise'];
    $dhuhr = $_POST['dhuhr'];
    $asr = $_POST['asr'];
    $maghrib = $_POST['maghrib'];
    $isha = $_POST['isha'];

    try {
        $stmt = $db->prepare("INSERT INTO prayer_times (city, month, date, fajr, sunrise, dhuhr, asr, maghrib, isha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$city, $month, $date, $fajr, $sunrise, $dhuhr, $asr, $maghrib, $isha]);
        $_SESSION['success'] = "نماز کے اوقات کامیابی سے شامل کر دیئے گئے";
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

header('Location: ../index.php');
exit; 