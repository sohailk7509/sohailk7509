<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php 
require_once 'admin/config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM articles_speeches WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    header("Location: index.php");
    exit();
}
?>

<!-- Rest of the file remains the same --> 