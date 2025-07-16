<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php 
require_once 'admin/config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
    header("Location: index.php");
    exit();
}

$date = new DateTime($news['created_at']);
?>

<div class="news-detail-container">
    <!-- Header Section -->
    <div class="news-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="logo-section">
                        <img src="assets/images/jamia-logo.png" alt="Jamia Logo" class="logo">
                        <div class="title-section">
                            <h1>جامعۃ العلوم الاسلامیۃ</h1>
                            <h2>علامہ محمد یوسف بنوری ٹاؤن کراچی، پاکستان</h2>
                            <h3>تازہ ترین خبریں</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Content -->
    <div class="news-content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="news-card">
                        <!-- News Image -->
                        <div class="news-image">
                            <img src="uploads/news/<?php echo $news['image']; ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="img-fluid">
                            <div class="news-date">
                                <div class="date-inner">
                                    <span class="day"><?php echo $date->format('d'); ?></span>
                                    <span class="month"><?php echo $news['month']; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- News Content -->
                        <div class="news-content">
                            <h1 class="news-title"><?php echo htmlspecialchars($news['title']); ?></h1>
                            <div class="news-meta">
                                <span><i class="far fa-calendar-alt"></i> <?php echo $date->format('d-m-Y'); ?></span>
                            </div>
                            <div class="news-text">
                                <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                            </div>
                            <div class="news-footer">
                                <a href="index.php" class="back-btn">
                                    <i class="fas fa-arrow-right"></i>
                                    واپس جائیں
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.news-detail-container {
    direction: rtl;
    font-family: 'Noto Nastaliq Urdu', serif;
}

.news-header {
    background-color: #3c2f1b;
    padding: 20px 0;
    text-align: center;
    border-bottom: 4px solid #b3997d;
}

.logo-section {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.logo {
    width: 80px;
    height: auto;
}

.title-section {
    color: #fff;
    text-align: center;
}

.title-section h1 {
    font-size: 2.2rem;
    margin-bottom: 5px;
}

.title-section h2 {
    font-size: 1.4rem;
    margin-bottom: 5px;
    opacity: 0.9;
}

.title-section h3 {
    font-size: 1.8rem;
    color: #b3997d;
    margin: 0;
}

.news-content-section {
    padding: 40px 0;
    background-color: #f8f9fa;
}

.news-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.news-image {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-date {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 2;
}

.date-inner {
    background: #b3997d;
    padding: 15px 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.news-date .day {
    display: block;
    color: #fff;
    font-size: 2rem;
    font-weight: bold;
    line-height: 1;
    margin-bottom: 3px;
}

.news-date .month {
    display: block;
    color: #fff;
    font-size: 1.1rem;
}

.news-content {
    padding: 30px;
}

.news-title {
    color: #3c2f1b;
    font-size: 2rem;
    margin-bottom: 15px;
    line-height: 1.4;
}

.news-meta {
    color: #666;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.news-meta span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.news-text {
    color: #444;
    font-size: 1.2rem;
    line-height: 2;
    margin-bottom: 30px;
}

.news-footer {
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.back-btn {
    color: #b3997d;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    padding: 10px 20px;
    border: 2px solid #b3997d;
    border-radius: 8px;
}

.back-btn:hover {
    background: #b3997d;
    color: #fff;
}

@media (max-width: 768px) {
    .logo-section {
        flex-direction: column;
    }

    .title-section h1 {
        font-size: 1.8rem;
    }

    .title-section h2 {
        font-size: 1.2rem;
    }

    .title-section h3 {
        font-size: 1.5rem;
    }

    .news-image {
        height: 250px;
    }

    .news-title {
        font-size: 1.5rem;
    }

    .news-content {
        padding: 20px;
    }
}
</style>

<?php include 'header/footer.php'; ?> 