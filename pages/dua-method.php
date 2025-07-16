<?php
require_once 'admin/config/db.php';

// Get dua details from database
try {
    $stmt = $db->prepare("SELECT * FROM duas WHERE category = 'dua-method' AND status = 1 ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $dua = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get dua categories for sidebar
    $stmt = $db->query("SELECT * FROM dua_categories WHERE slug != 'dua-method' ORDER BY name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
}
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content-box">
                    <?php if($dua): ?>
                        <div class="article-header">
                            <h1><?php echo htmlspecialchars($dua['title']); ?></h1>
                            <div class="meta">
                                <span><i class="fas fa-calendar"></i> تاریخ اشاعت: <?php echo date('d-m-Y', strtotime($dua['created_at'])); ?></span>
                            </div>
                        </div>

                        <div class="article-content">
                            <?php if(!empty($dua['arabic_text'])): ?>
                                <div class="arabic-text">
                                    <?php echo $dua['arabic_text']; ?>
                                </div>
                            <?php endif; ?>

                            <div class="translation">
                                <?php echo $dua['translation']; ?>
                            </div>

                            <?php if(!empty($dua['reference'])): ?>
                                <div class="reference">
                                    حوالہ: <?php echo htmlspecialchars($dua['reference']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            دعا کی تفصیلات دستیاب نہیں ہیں۔
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar-box">
                    <h3>مزید دعائیں</h3>
                    <ul class="related-duas">
                        <?php foreach($categories as $category): ?>
                            <li>
                                <a href="?page=dua&category=<?php echo $category['slug']; ?>">
                                    <?php 
                                    // Add appropriate icon based on category
                                    $icon = 'pray';
                                    switch($category['slug']) {
                                        case 'toba-wa-istighfar':
                                            $icon = 'hand-holding-heart';
                                            break;
                                        case 'masjid-namaz':
                                            $icon = 'mosque';
                                            break;
                                        case 'subha-sham':
                                            $icon = 'sun';
                                            break;
                                        case 'safar':
                                            $icon = 'route';
                                            break;
                                        case 'khane-peney':
                                            $icon = 'utensils';
                                            break;
                                        case 'libas':
                                            $icon = 'tshirt';
                                            break;
                                    }
                                    ?>
                                    <i class="fas fa-<?php echo $icon; ?>"></i>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.inner-section {
    padding: 50px 0;
    background: #f8f9fa;
}

.content-box {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.article-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.article-header h1 {
    color: #3c2f1b;
    font-size: 32px;
    margin-bottom: 15px;
}

.meta {
    color: #666;
    font-size: 14px;
}

.meta i {
    margin-left: 5px;
    color: #b3997d;
}

.dua-section {
    margin-bottom: 40px;
}

.dua-section h3 {
    color: #3c2f1b;
    font-size: 24px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.method-points .point {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.method-points .point i {
    color: #b3997d;
    font-size: 20px;
    margin-left: 15px;
}

.important-points {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.important-points h4 {
    color: #3c2f1b;
    margin-bottom: 15px;
}

.important-points ul {
    list-style: none;
    padding: 0;
}

.important-points ul li {
    margin-bottom: 10px;
    padding-right: 20px;
    position: relative;
}

.important-points ul li:before {
    content: "•";
    color: #b3997d;
    position: absolute;
    right: 0;
}

.arabic-text {
    font-family: 'Noto Naskh Arabic', serif;
    font-size: 24px;
    line-height: 2;
    text-align: right;
    margin: 20px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.translation {
    font-size: 16px;
    line-height: 1.8;
    color: #666;
    margin: 20px 0;
}

.reference {
    color: #b3997d;
    font-style: italic;
}

.sidebar-box {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.sidebar-box h3 {
    color: #3c2f1b;
    font-size: 20px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.related-duas {
    list-style: none;
    padding: 0;
}

.related-duas li {
    margin-bottom: 10px;
}

.related-duas li a {
    display: flex;
    align-items: center;
    color: #3c2f1b;
    text-decoration: none;
    padding: 12px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
    background: #f8f9fa;
    margin-bottom: 8px;
}

.related-duas li a:hover {
    background: #eee;
    color: #b3997d;
    transform: translateX(-5px);
}

.related-duas li a i {
    margin-left: 12px;
    color: #b3997d;
    font-size: 18px;
    width: 25px;
    text-align: center;
}

@media (max-width: 768px) {
    .content-box {
        padding: 20px;
    }
    
    .article-header h1 {
        font-size: 24px;
    }
    
    .arabic-text {
        font-size: 20px;
    }
}
</style> 