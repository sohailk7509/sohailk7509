<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php require_once 'admin/config/db.php'; ?>

<section class="all-articles py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>منتخب مضامین</h2>
            <div class="section-divider">
                <span class="line"></span>
                <span class="icon"><i class="fas fa-book"></i></span>
                <span class="line"></span>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $articles = $db->query("SELECT * FROM articles WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
            foreach($articles as $article):
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="content-box">
                    <?php if($article['image']): ?>
                    <div class="article-image">
                        <img src="uploads/articles/<?php echo $article['image']; ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="img-fluid">
                    </div>
                    <?php endif; ?>
                    <div class="article-content">
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <div class="article-meta">
                            <span class="category"><?php echo htmlspecialchars($article['category']); ?></span>
                            <span class="date"><?php echo date('d-m-Y', strtotime($article['created_at'])); ?></span>
                        </div>
                        <p><?php echo htmlspecialchars(substr($article['content'], 0, 150)) . '...'; ?></p>
                        <a href="article.php?id=<?php echo $article['id']; ?>" class="read-more">
                            مزید پڑھیں 
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.all-articles {
    direction: rtl;
    background-color: #f8f9fa;
}

.section-header h2 {
    color: #3c2f1b;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.content-box {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.content-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(179, 153, 125, 0.2);
}

.article-image {
    height: 200px;
    overflow: hidden;
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-content {
    padding: 20px;
}

.article-content h3 {
    color: #3c2f1b;
    font-size: 1.3rem;
    margin-bottom: 10px;
    line-height: 1.4;
}

.article-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.category {
    background: #b3997d;
    color: #fff;
    padding: 3px 10px;
    border-radius: 4px;
    font-size: 0.9rem;
}

.date {
    color: #666;
    font-size: 0.9rem;
}

.read-more {
    color: #b3997d;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: #3c2f1b;
}

@media (max-width: 768px) {
    .section-header h2 {
        font-size: 2rem;
    }
    
    .article-content h3 {
        font-size: 1.1rem;
    }
}
</style>

<?php include 'header/footer.php'; ?> 