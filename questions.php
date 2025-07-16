<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php 
require_once 'admin/config/db.php';

// Fetch published questions
$stmt = $db->prepare("SELECT * FROM questions WHERE status = 'published' ORDER BY created_at DESC");
$stmt->execute();
$questions = $stmt->fetchAll();
?>

<!-- Questions Section -->
<section class="questions-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-5">
                    <h2 class="mb-3">سوالات و جوابات</h2>
                    <p>دارالافتاء جامعہ علوم اسلامیہ بنوری ٹاؤن کراچی</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach($questions as $question): ?>
            <div class="col-md-6 mb-4">
                <div class="question-card">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="category-badge mb-2">
                                <span class="badge bg-primary"><?php echo htmlspecialchars($question['category']); ?></span>
                            </div>
                            <h5 class="card-title"><?php echo htmlspecialchars($question['title']); ?></h5>
                            <div class="question-preview">
                                <?php 
                                $preview = substr(strip_tags($question['content']), 0, 150);
                                echo htmlspecialchars($preview) . '...'; 
                                ?>
                            </div>
                            <button class="btn btn-link mt-2" onclick="toggleAnswer(this)">
                                مکمل جواب دیکھیں <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="answer-content" style="display: none;">
                                <?php echo nl2br(htmlspecialchars($question['content'])); ?>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt"></i> 
                                <?php echo date('d-m-Y', strtotime($question['created_at'])); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'header/footer.php'; ?> 

<!-- Add this CSS to your style.css file -->
<style>
.question-card {
    height: 100%;
}
.question-card .card {
    height: 100%;
    border: none;
    transition: all 0.3s ease;
}
.question-card .card:hover {
    transform: translateY(-5px);
}
.question-preview {
    color: #666;
    font-size: 0.9rem;
}
.answer-content {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}
.category-badge .badge {
    background-color: #b3997d !important;
    font-size: 0.8rem;
}
.btn-link {
    color: #b3997d;
    text-decoration: none;
    position: relative;
    padding: 5px 0;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-link:hover {
    color: #9f886f;
}
.btn-link.active {
    color: #9f886f;
    font-weight: bold;
}
.btn-link.active i {
    transform: rotate(180deg);
    transition: transform 0.3s ease;
}
.btn-link i {
    margin-right: 5px;
    transition: transform 0.3s ease;
}
.card-footer {
    border-top: 1px solid rgba(0,0,0,.05);
}
.btn-link i {
    margin-right: 0;
    margin-left: 5px;
}
.question-card {
    text-align: right;
    direction: rtl;
}
</style>

<!-- Add this JavaScript -->
<script>
function toggleAnswer(button) {
    const answerContent = button.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (answerContent.style.display === 'none') {
        // Show answer
        answerContent.style.display = 'block';
        answerContent.style.opacity = '0';
        setTimeout(() => {
            answerContent.style.opacity = '1';
        }, 10);
        icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
        button.classList.add('active');
    } else {
        // Hide answer
        answerContent.style.opacity = '0';
        setTimeout(() => {
            answerContent.style.display = 'none';
        }, 300);
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        button.classList.remove('active');
    }
}
</script>