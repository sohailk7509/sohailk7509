<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php 
require_once 'admin/config/db.php';

// Get question ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch question details
$stmt = $db->prepare("SELECT * FROM featured_questions WHERE id = ?");
$stmt->execute([$id]);
$question = $stmt->fetch();

// If question not found, redirect to questions page
if (!$question) {
    // header("Location: questions.php");
    exit();
}
?>

<!-- Darul Ifta Header -->
<!-- <div class="darul-ifta-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="assets/images/logo.png" alt="Jamia Logo" class="logo">
                <div class="header-text">
                    <h1>جامعۃ العلوم الاسلامیۃ</h1>
                    <h2>علامہ محمد یوسف بنوری ٹاؤن کراچی، پاکستان</h2>
                    <h3>دارالافتاء</h3>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Add this after the darul-ifta-header div -->
<div class="fatwa-details">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="details-box">
                    <div class="detail-row">
                        <span class="detail-label">دارالافتاء:</span>
                        <span class="detail-value">دارالافتاء جامعہ علوم اسلامیہ علامہ محمد یوسف بنوری ٹاؤن</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">فتویٰ نمبر:</span>
                        <span class="detail-value" style="direction: ltr;"><?php echo htmlspecialchars($question['fatwa_number'] ?? '144610100740'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Question Content -->
<div class="fatwa-content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- Question Title -->
                <div class="fatwa-title">
                    <?php echo htmlspecialchars($question['title']); ?>
                </div>

                <!-- Question -->
                <div class="fatwa-section">
                    <div class="section-heading">سوال</div>
                    <div class="section-content">
                        <?php echo nl2br(htmlspecialchars($question['question'])); ?>
                    </div>
                </div>

                <!-- Answer -->
                <div class="fatwa-section">
                    <div class="section-heading">جواب</div>
                    <div class="section-content">
                        <?php echo nl2br(htmlspecialchars($question['answer'])); ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="fatwa-sidebar">
                    <!-- <div class="search-box">
                        <h4>تلاش کریں</h4>
                        <form>
                            <input type="text" class="form-control" placeholder="مطلوبہ الفاظ">
                        </form>
                    </div> -->
                    
                    <div class="categories">
                        <h4>زمرہ جات</h4>
                        <ul>
                            <li><a href="#">نماز کے مسائل</a></li>
                            <li><a href="#">روزہ کے مسائل</a></li>
                            <li><a href="#">زکوٰۃ کے مسائل</a></li>
                            <li><a href="#">حج کے مسائل</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php include 'header/footer.php'; ?>

<style>
/* Darul Ifta Header */
.darul-ifta-header {
    background: #5c4d3e url('assets/images/header-bg.jpg') repeat;
    padding: 30px 0;
    text-align: center;
    color: #fff;
    border-bottom: 5px solid #b3997d;
}

.darul-ifta-header .logo {
    width: 120px;
    margin-bottom: 20px;
}

.darul-ifta-header .header-text h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.darul-ifta-header .header-text h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.darul-ifta-header .header-text h3 {
    font-size: 2.2rem;
    color: #b3997d;
}

/* Fatwa Content */
.fatwa-content {
    background: #f5f5f5;
    padding: 40px 0;
    direction: rtl;
    text-align: right;
}

.fatwa-title {
    background: #5c4d3e;
    color: #fff;
    padding: 15px 20px;
    font-size: 1.4rem;
    margin-bottom: 20px;
    border-radius: 5px;
}

.fatwa-section {
    background: #fff;
    margin-bottom: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.section-heading {
    background: #b3997d;
    color: #fff;
    padding: 10px 20px;
    font-size: 1.2rem;
    border-radius: 5px 5px 0 0;
}

.section-content {
    padding: 20px;
    font-size: 1.1rem;
    line-height: 1.8;
}

/* Sidebar */
.fatwa-sidebar {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.search-box {
    margin-bottom: 30px;
}

.search-box h4 {
    color: #5c4d3e;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.categories h4 {
    color: #5c4d3e;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.categories ul {
    list-style: none;
    padding: 0;
}

.categories ul li {
    margin-bottom: 10px;
}

.categories ul li a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s;
}

.categories ul li a:hover {
    color: #b3997d;
}

/* RTL Specific */
body {
    font-family: 'Noto Nastaliq Urdu', serif;
}

.form-control {
    text-align: right;
}

@media (max-width: 768px) {
    .darul-ifta-header .header-text h1 {
        font-size: 2rem;
    }
    
    .darul-ifta-header .header-text h2 {
        font-size: 1.4rem;
    }
    
    .darul-ifta-header .header-text h3 {
        font-size: 1.8rem;
    }
    
    .fatwa-title {
        font-size: 1.2rem;
    }
}

.fatwa-details {
    background: #f5f5f5;
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
    direction: rtl;
}

.details-box {
    background: #fff;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.detail-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.detail-row:last-child {
    margin-bottom: 0;
}

.detail-label {
    color: #5c4d3e;
    font-weight: bold;
    margin-left: 10px;
    min-width: 100px;
}

.detail-value {
    color: #666;
}

@media (max-width: 768px) {
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .detail-label {
        margin-bottom: 5px;
    }
}
</style> 