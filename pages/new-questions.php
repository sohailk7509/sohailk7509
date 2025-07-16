<?php
require_once 'admin/config/db.php';

// Handle pagination (GET parameter "p")
$limit = 10;
$pageParam = isset($_GET['p']) && is_numeric($_GET['p']) ? (int) $_GET['p'] : 1;
$offset = ($pageParam - 1) * $limit;

// Count total "new" questions
$countStmt = $db->query("SELECT COUNT(*) FROM featured_questions WHERE type = 'new'");
$totalQuestions = $countStmt->fetchColumn();
$totalPages = ceil($totalQuestions / $limit);

// Fetch paginated data
$stmt = $db->prepare("SELECT * FROM featured_questions WHERE type = 'new' ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preserve other query parameters (e.g. page=new-questions)
$queryParams = $_GET;
unset($queryParams['p']);
$baseURL = strtok($_SERVER["REQUEST_URI"], '?');
$baseQuery = http_build_query($queryParams);
$baseLink = $baseURL . ($baseQuery ? '?' . $baseQuery . '&' : '?');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background-color: #fff;
    font-family: 'Noto Nastaliq Urdu', 'Segoe UI', sans-serif;
    direction: rtl;
}
.section-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #781f1f;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #ddd3c3;
    display: inline-block;
    padding-bottom: 0.5rem;
}
.question-item {
    border-bottom: 1px solid #e4d9c9;
    padding: 1rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.question-text {
    font-size: 1.05rem;
    color: #3e3e3e;
    margin: 0;
    text-align: right;
    flex: 1;
    text-decoration: none !important;
    transition: color 0.2s;
}
.question-icon {
    font-size: 1.2rem;
    color: #916c4d;
    margin-left: 1rem;
}
.question-text:hover {
    color: #5c3d29;
}
.pagination-wrapper {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}
.pagination li {
    margin: 0 3px;
}
.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    color: #333;
    font-size: 16px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}
.pagination li.active a {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}
.pagination li a:hover {
    background-color: #f0f0f0;
}
.pagination li a.disabled {
    pointer-events: none;
    opacity: 0.5;
}
.pagination li span.dots {
    cursor: default;
    color: #aaa;
}
</style>

<section class="fatwa-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9 col-md-push-3">
                <div class="text-end section-title">نئے سوالات</div>

                <?php if (count($questions) > 0): ?>
                    <?php foreach ($questions as $q): ?>
                        <div class="question-item">
                            <i class="bi bi-question-circle-fill question-icon"></i>
                            <a href="question.php?id=<?= htmlspecialchars($q['id']) ?>" class="question-text">
                                <?= htmlspecialchars($q['title']) ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">کوئی سوال دستیاب نہیں۔</p>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <!-- Prev -->
                            <li>
                                <a href="<?= $baseLink ?>p=<?= max($pageParam - 1, 1) ?>" class="<?= $pageParam == 1 ? 'disabled' : '' ?>">&lt;</a>
                            </li>

                            <?php
                            $range = 1;
                            $dotShown = false;

                            for ($i = 1; $i <= $totalPages; $i++) {
                                if (
                                    $i == 1 ||
                                    $i == $totalPages ||
                                    ($i >= $pageParam - $range && $i <= $pageParam + $range)
                                ) {
                                    $dotShown = false;
                                    echo '<li class="' . ($i == $pageParam ? 'active' : '') . '"><a href="' . $baseLink . 'p=' . $i . '">' . $i . '</a></li>';
                                } elseif (!$dotShown) {
                                    echo '<li><span class="dots">...</span></li>';
                                    $dotShown = true;
                                }
                            }
                            ?>

                            <!-- Next -->
                            <li>
                                <a href="<?= $baseLink ?>p=<?= min($pageParam + 1, $totalPages) ?>" class="<?= $pageParam == $totalPages ? 'disabled' : '' ?>">&gt;</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
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
                    <!-- Uncomment below if needed -->
                    <!-- <a href="ask-question.php" class="btn-ask">نیا سوال پوچھیں</a> -->
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

