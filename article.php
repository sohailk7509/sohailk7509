<?php
// Start output buffering at the very beginning
ob_start();

include 'header/mainheader.php';
include 'header/header.php';
require_once 'admin/config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM speeches WHERE id = ? AND category = 'منتخب مضامین'");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    header("Location: index.php");
    ob_end_flush(); // Flush the buffer before exit
    exit();
}
?>

<section class="article-detail py-5">
    <div class="container">
        <div class="article-content">
            <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            <div class="article-meta">
                <span class="date"><?php echo date('d-m-Y', strtotime($article['created_at'])); ?></span>
            </div>
            <div class="content">
                <?php echo $article['content']; ?>
            </div>
        </div>
    </div>
</section>

<style>
.article-detail {
    direction: rtl;
    background-color: #f8f9fa;
}

.article-content {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.article-content h1 {
    color: #3c2f1b;
    font-size: 2rem;
    margin-bottom: 20px;
}

.article-meta {
    margin-bottom: 20px;
    color: #666;
}

.article-meta .date {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.article-meta .date:before {
    content: '\f073';
    font-family: 'Font Awesome 5 Free';
    font-weight: 400;
}

.content {
    line-height: 1.8;
    color: #333;
}

@media (max-width: 768px) {
    .article-content {
        padding: 20px;
    }
    
    .article-content h1 {
        font-size: 1.5rem;
    }
}
</style>

<?php 
include 'header/footer.php';
ob_end_flush(); // Flush the output buffer at the end
?> 