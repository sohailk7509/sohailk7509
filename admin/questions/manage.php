<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $stmt = $db->prepare("INSERT INTO questions (title, content, category, status) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST['title'], $_POST['content'], $_POST['category'], $_POST['status']]);
                break;

            case 'edit':
                $stmt = $db->prepare("UPDATE questions SET title = ?, content = ?, category = ?, status = ? WHERE id = ?");
                $stmt->execute([$_POST['title'], $_POST['content'], $_POST['category'], $_POST['status'], $_POST['id']]);
                break;

            case 'delete':
                $stmt = $db->prepare("DELETE FROM questions WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                break;
        }
        header("Location: manage.php");
        exit();
    }
}

// Get all questions
$questions = $db->query("SELECT * FROM questions ORDER BY created_at DESC")->fetchAll();
?>

<?php require_once '../includes/header.php'  ?>
    <!-- Include sidebar and navbar -->
    <?php include '../includes/sidebar.php'; ?>
    
    <div class="container-fluid px-4">
        <h2 class="mt-4">Manage Questions</h2>
        
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
            Add New Question
        </button>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($questions as $question): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($question['title']); ?></td>
                            <td><?php echo htmlspecialchars($question['category']); ?></td>
                            <td><?php echo htmlspecialchars($question['status']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($question['created_at'])); ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="editQuestion(<?php echo $question['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteQuestion(<?php echo $question['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Question Modal -->
    <?php include 'modals/question-modal.php'; ?>

    <!-- Peace Section -->
    <section class="peace-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-section">
                        <div class="header-section brown">
                            <h2>سکون و اطمینان</h2>
                        </div>
                        <div class="peace-content">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="peace-item">
                                        <div class="peace-image">
                                            <img src="assets/images/quran.jpg" alt="قرآن مجید کی تلاوت" class="img-fluid">
                                        </div>
                                        <div class="peace-text">
                                            <h3>قرآن مجید کی تلاوت</h3>
                                            <p>روزانہ قرآن مجید کی تلاوت کریں اور اس کے معانی سمجھیں</p>
                                            <a href="quran.php" class="read-more">مزید پڑھیں <i class="fas fa-chevron-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="peace-item">
                                        <div class="peace-image">
                                            <img src="assets/images/azkar.jpg" alt="ذکر و اذکار" class="img-fluid">
                                        </div>
                                        <div class="peace-text">
                                            <h3>ذکر و اذکار</h3>
                                            <p>صبح و شام کے اذکار اور مسنون دعائیں</p>
                                            <a href="azkar.php" class="read-more">مزید پڑھیں <i class="fas fa-chevron-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="peace-item">
                                        <div class="peace-image">
                                            <img src="assets/images/tazkiya.jpg" alt="تزکیہ نفس" class="img-fluid">
                                        </div>
                                        <div class="peace-text">
                                            <h3>تزکیہ نفس</h3>
                                            <p>نفس کی اصلاح اور روحانی ترقی کے لیے رہنمائی</p>
                                            <a href="tazkiya.php" class="read-more">مزید پڑھیں <i class="fas fa-chevron-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Peace Section Styling */
    .peace-section {
        margin: 30px 0;
        direction: rtl;
    }

    .peace-content {
        padding: 30px;
    }

    .peace-item {
        background: #fff;
        border: 1px solid #e0d5cc;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .peace-item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .peace-image {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .peace-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .peace-item:hover .peace-image img {
        transform: scale(1.1);
    }

    .peace-text {
        padding: 20px;
    }

    .peace-text h3 {
        color: #4a3426;
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .peace-text p {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .peace-text .read-more {
        color: #8B4513;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .peace-text .read-more:hover {
        color: #5c2d0c;
        gap: 8px;
    }

    .header-section.brown {
        background-color: #8B4513;
        color: #fff;
        border-radius: 8px 8px 0 0;
        padding: 15px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .peace-content {
            padding: 20px;
        }

        .peace-image {
            height: 160px;
        }

        .peace-text {
            padding: 15px;
        }

        .peace-text h3 {
            font-size: 16px;
        }

        .peace-text p {
            font-size: 13px;
        }
    }
    </style>

    <script src="../assets/js/admin-script.js"></script>
</body>
</html> 