<?php
ob_start();

include 'header/mainheader.php';
include 'header/header.php';
require_once 'admin/config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM speeches WHERE id = ? AND category = 'بیانات نور'");
$stmt->execute([$id]);
$speech = $stmt->fetch();

if (!$speech) {
    header("Location: index.php");
    ob_end_flush();
    exit();
}
?>

<section class="speech-detail py-5">
    <div class="container">
        <div class="speech-content">
            <h1><?php echo htmlspecialchars($speech['title']); ?></h1>
            <div class="speech-meta">
                <span class="date"><?php echo date('d-m-Y', strtotime($speech['created_at'])); ?></span>
            </div>
            <div class="content">
                <?php echo $speech['content']; ?>
            </div>
        </div>
    </div>
</section>

<style>
.speech-detail {
    direction: rtl;
    background-color: #f8f9fa;
}

.speech-content {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.speech-content h1 {
    color: #3c2f1b;
    font-size: 2rem;
    margin-bottom: 20px;
}

.speech-meta {
    margin-bottom: 20px;
    color: #666;
}

.speech-meta .date {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.speech-meta .date:before {
    content: '\f073';
    font-family: 'Font Awesome 5 Free';
    font-weight: 400;
}

.content {
    line-height: 1.8;
    color: #333;
}

@media (max-width: 768px) {
    .speech-content {
        padding: 20px;
    }
    
    .speech-content h1 {
        font-size: 1.5rem;
    }
}
</style>

<?php 
include 'header/footer.php';
ob_end_flush();
?> 