<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="dua-detail">
                    <h1><?php echo htmlspecialchars($dua['title']); ?></h1>
                    <div class="category">زمرہ: <?php echo $dua['category_name']; ?></div>
                    
                    <div class="arabic-text"><?php echo $dua['arabic_text']; ?></div>
                    <div class="translation"><?php echo $dua['translation']; ?></div>
                    
                    <?php if (!empty($dua['reference'])): ?>
                        <div class="reference">حوالہ: <?php echo $dua['reference']; ?></div>
                    <?php endif; ?>
                    
                    <div class="actions mt-4">
                        <a href="?page=dua&category=<?php echo $dua['category']; ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-right ml-2"></i>
                            واپس جائیں
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.dua-detail {
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.dua-detail h1 {
    color: #3c2f1b;
    margin-bottom: 10px;
}

.category {
    color: #b3997d;
    margin-bottom: 20px;
}

.arabic-text {
    font-family: 'Noto Naskh Arabic', serif;
    font-size: 28px;
    line-height: 2;
    margin: 25px 0;
    text-align: right;
}

.translation {
    font-size: 18px;
    line-height: 1.8;
    margin: 25px 0;
    color: #666;
}

.reference {
    font-size: 16px;
    color: #b3997d;
    margin-top: 15px;
}

.actions .btn {
    padding: 10px 20px;
}

.actions .btn i {
    margin-left: 8px;
}
</style> 