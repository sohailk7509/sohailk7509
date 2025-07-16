<?php

include 'header/mainheader.php';
include 'header/header.php';
include 'header/header-point.php';

require_once 'admin/config/db.php';

try {
    // Pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($page < 1) $page = 1;
    
    $perPage = 10;
    $start = ($page - 1) * $perPage;
    
    // Get total questions count
    $stmt = $db->query("SELECT COUNT(*) FROM questions WHERE status = 'published'");
    $total = $stmt->fetchColumn();
    $totalPages = ceil($total / $perPage);
    
    // Get questions for current page
    $stmt = $db->prepare("SELECT * FROM questions WHERE status = 'published' ORDER BY created_at DESC LIMIT :start, :perPage");
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', (int)$perPage, PDO::PARAM_INT);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    echo "<!-- Error: " . $e->getMessage() . " -->";
    $questions = [];
    $total = 0;
    $totalPages = 0;
}

// Debug output
echo "<!-- Total questions: " . $total . " -->";
echo "<!-- Current page: " . $page . " -->";
?>

<section class="fatwa-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9 col-md-push-3">
                <div class="fatwa-box">
                    <div class="section-title">
                        <span class="title-icon"><i class="fas fa-book-open"></i></span>
                        <h2>نئے سوالات</h2>
                    </div>

                    <?php if(!empty($questions)): ?>
                        <div class="fatwa-list">
                            <?php foreach($questions as $question): ?>
                            <div class="fatwa-card">
                                <div class="fatwa-header">
                                    <div class="category-tag">
                                        <i class="fas fa-folder"></i>
                                        <?php echo htmlspecialchars($question['category']); ?>
                                    </div>
                                    <div class="date-tag">
                                        <i class="far fa-calendar"></i>
                                        <?php echo date('d-m-Y', strtotime($question['created_at'])); ?>
                                    </div>
                                </div>
                                
                                <div class="fatwa-body">
                                    <h3>
                                        <a href="question.php?id=<?php echo $question['id']; ?>">
                                            <?php echo htmlspecialchars($question['title']); ?>
                                        </a>
                                    </h3>
                                    <div class="fatwa-excerpt">
                                        <?php 
                                        $content = strip_tags($question['content']);
                                        echo mb_substr($content, 0, 150) . '...'; 
                                        ?>
                                    </div>
                                </div>

                                <div class="fatwa-footer">
                                    <div class="status-badge <?php echo $question['status'] == 'published' ? 'answered' : 'pending'; ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <?php echo $question['status'] == 'published' ? 'جواب موجود ہے' : 'زیر غور'; ?>
                                    </div>
                                    <a href="question.php?id=<?php echo $question['id']; ?>" class="read-more">
                                        مکمل پڑھیں <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if($totalPages > 1): ?>
                        <div class="pagination-wrapper">
                            <ul class="pagination">
                                <?php if($page > 1): ?>
                                    <li><a href="?page=<?php echo $page-1; ?>" class="prev-page"><i class="fas fa-chevron-right"></i></a></li>
                                <?php endif; ?>
                                
                                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="<?php echo $page == $i ? 'active' : ''; ?>">
                                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if($page < $totalPages): ?>
                                    <li><a href="?page=<?php echo $page+1; ?>" class="next-page"><i class="fas fa-chevron-left"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="no-results">
                            <i class="fas fa-inbox"></i>
                            <p>کوئی سوال موجود نہیں ہے</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3 col-md-pull-9">
                <div class="sidebar-box search-box">
                    <div class="box-title">
                        <i class="fas fa-search"></i>
                        <h3>تلاش کریں</h3>
                    </div>
                    <form action="search-questions.php" method="get">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="سوال تلاش کریں...">
                        </div>
                        <button type="submit" class="btn-search">تلاش کریں</button>
                    </form>
                </div>

                <div class="sidebar-box ask-box">
                    <div class="box-title">
                        <i class="fas fa-question-circle"></i>
                        <h3>سوال پوچھیں</h3>
                    </div>
                    <p>اپنا سوال پوچھنے کے لیے نیچے کلک کریں</p>
                    <a href="ask-question.php" class="btn-ask">نیا سوال پوچھیں</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Main Styles */
.fatwa-section {
    padding: 40px 0;
    background: #f8f9fa;
}

/* Fatwa Box Styles */
.fatwa-box {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.05);
    padding: 30px;
}

/* Section Title */
.section-title {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.title-icon {
    width: 50px;
    height: 50px;
    background: #3c2f1b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
}

.title-icon i {
    color: #fff;
    font-size: 24px;
}

.section-title h2 {
    color: #3c2f1b;
    font-size: 24px;
    margin: 0;
    font-weight: bold;
}

/* Fatwa Card */
.fatwa-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
    overflow: hidden;
}

.fatwa-card:hover {
    transform: translateY(-5px);
}

/* Fatwa Header */
.fatwa-header {
    display: flex;
    justify-content: space-between;
    padding: 15px 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #eee;
}

.category-tag, .date-tag {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 14px;
}

.category-tag i, .date-tag i {
    margin-left: 8px;
    color: #3c2f1b;
}

/* Fatwa Body */
.fatwa-body {
    padding: 20px;
}

.fatwa-body h3 {
    font-size: 18px;
    margin: 0 0 15px;
}

.fatwa-body h3 a {
    color: #3c2f1b;
    text-decoration: none;
    transition: color 0.3s;
}

.fatwa-body h3 a:hover {
    color: #b3997d;
}

.fatwa-excerpt {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

/* Fatwa Footer */
.fatwa-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-top: 1px solid #eee;
}

.status-badge {
    display: flex;
    align-items: center;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.status-badge.answered {
    background: #e8f5e9;
    color: #2e7d32;
}

.status-badge.pending {
    background: #fff3e0;
    color: #ef6c00;
}

.status-badge i {
    margin-left: 8px;
}

.read-more {
    color: #3c2f1b;
    text-decoration: none;
    font-weight: bold;
    display: flex;
    align-items: center;
    transition: color 0.3s;
}

.read-more:hover {
    color: #b3997d;
}

.read-more i {
    margin-right: 8px;
}

/* Sidebar Styles */
.sidebar-box {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    padding: 25px;
    margin-bottom: 30px;
}

.box-title {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.box-title i {
    font-size: 24px;
    color: #3c2f1b;
    margin-left: 10px;
}

.box-title h3 {
    color: #3c2f1b;
    font-size: 18px;
    margin: 0;
}

/* Form Elements */
.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 12px 15px;
    width: 100%;
    margin-bottom: 15px;
}

.btn-search, .btn-ask {
    width: 100%;
    background: #3c2f1b;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-search:hover, .btn-ask:hover {
    background: #b3997d;
    transform: translateY(-2px);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 50%;
    color: #3c2f1b;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination li.active a {
    background: #3c2f1b;
    color: #fff;
}

.pagination li a:hover {
    background: #f0f0f0;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 40px 20px;
}

.no-results i {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 15px;
}

.no-results p {
    color: #666;
    font-size: 16px;
    margin: 0;
}
</style>

