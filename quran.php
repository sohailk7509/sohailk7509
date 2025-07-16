<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php require_once 'admin/config/db.php'; ?>

<section class="peace-detail-section py-5">
    <div class="container">
        <div class="content-section">
            <div class="header-section brown">
                <h2>قرآن مجید کی تلاوت</h2>
            </div>
            <div class="peace-detail-content">
                <div class="quran-content">
                    <h3>روزانہ قرآن مجید کی تلاوت کریں اور اس کے معانی سمجھیں</h3>
                    <!-- Add your Quran content/embed here -->
                    <div class="quran-embed">
                        <!-- Your Quran player/embed code -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 

<style>
.peace-detail-section {
    direction: rtl;
    background-color: #f8f9fa;
}

.peace-detail-content {
    background: #fff;
    padding: 30px;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.peace-detail-content h3 {
    color: #4a3426;
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: 600;
}

.quran-content,
.azkar-content,
.tazkiya-content {
    margin-top: 20px;
}

.quran-embed {
    margin: 20px 0;
    border-radius: 8px;
    overflow: hidden;
}

@media (max-width: 768px) {
    .peace-detail-content {
        padding: 20px;
    }
    
    .peace-detail-content h3 {
        font-size: 20px;
    }
}

.header-section.brown {
    background-color: #8B4513;
    color: #fff;
    border-radius: 8px 8px 0 0;
    padding: 15px;
    text-align: center;
}
</style> 