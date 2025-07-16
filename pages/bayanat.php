<?php
require_once 'admin/config/db.php';

// Initialize variables
$article = null;
$error = null;

// Check for ID
if(!isset($_GET['id'])) {
    $error = 'مضمون کی شناخت موجود نہیں';
} else {
    $id = $_GET['id'];
    
    // Get article details
    try {
        if($id == 'internet' || $id == 'ramadan' || $id == 'hazrat-banuri') {
            // For category based articles
            $stmt = $db->prepare("SELECT * FROM bayanat WHERE category = ? ORDER BY created_at DESC LIMIT 1");
            $stmt->execute([$id]);
        } else {
            // For specific article
            $stmt = $db->prepare("SELECT * FROM bayanat WHERE id = ?");
            $stmt->execute([$id]);
        }
        
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$article) {
            $error = 'مضمون نہیں ملا';
        }
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        $error = 'ڈیٹابیس میں خرابی';
    }
}
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if($error): ?>
                    <div class="alert alert-warning">
                        <?php echo $error; ?>
                    </div>
                <?php else: ?>
                    <h1><?php echo htmlspecialchars($article['title']); ?></h1>
                    <div class="article-meta">
                        <span>تاریخ: <?php echo date('d-m-Y', strtotime($article['created_at'])); ?></span>
                        <span>مصنف: <?php echo htmlspecialchars($article['author']); ?></span>
                    </div>
                    <div class="article-content">
                        <?php echo $article['content']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.inner-section {
    padding: 40px 0;
}

.article-meta {
    margin: 20px 0;
    color: #666;
}

.article-meta span {
    margin-left: 20px;
}

.article-content {
    line-height: 1.8;
}
</style> 