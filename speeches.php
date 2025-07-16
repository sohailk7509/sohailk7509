<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php require_once 'admin/config/db.php'; ?>

<section class="all-speeches py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>بیانات نور</h2>
            <div class="section-divider">
                <span class="line"></span>
                <span class="icon"><i class="fas fa-microphone"></i></span>
                <span class="line"></span>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $speeches = $db->query("SELECT * FROM speeches WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
            foreach($speeches as $speech):
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="content-box">
                    <?php if($speech['image']): ?>
                    <div class="speech-image">
                        <img src="uploads/speeches/<?php echo $speech['image']; ?>" alt="<?php echo htmlspecialchars($speech['title']); ?>" class="img-fluid">
                    </div>
                    <?php endif; ?>
                    <div class="speech-content">
                        <h3><?php echo htmlspecialchars($speech['title']); ?></h3>
                        <div class="speech-meta">
                            <span class="date"><?php echo date('d-m-Y', strtotime($speech['created_at'])); ?></span>
                        </div>
                        <p><?php echo htmlspecialchars(substr($speech['content'], 0, 150)) . '...'; ?></p>
                        <a href="speech.php?id=<?php echo $speech['id']; ?>" class="read-more">
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
.all-speeches {
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

.speech-image {
    height: 200px;
    overflow: hidden;
}

.speech-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.speech-content {
    padding: 20px;
}

.speech-content h3 {
    color: #3c2f1b;
    font-size: 1.3rem;
    margin-bottom: 10px;
    line-height: 1.4;
}

.speech-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
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
    
    .speech-content h3 {
        font-size: 1.1rem;
    }
}
</style>

<?php include 'header/footer.php'; ?> 