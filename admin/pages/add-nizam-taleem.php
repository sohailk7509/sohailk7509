<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

// Check if page already exists
$stmt = $db->prepare("SELECT * FROM pages WHERE page_id = 'nizam-taleem' AND status = 1");
$stmt->execute();
$existingPage = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جامعہ کا نظام تعلیم شامل کریں</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 500px;
            direction: rtl;
        }
        label {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .card-title {
            font-size: 1.5rem;
            color: #2c3e50;
        }
        .btn-primary {
            background-color: var(--main-bg-color);
            border-color: var(--main-bg-color);
        }
        .btn-primary:hover {
            background-color: var(--main-text-color);
            border-color: var(--main-text-color);
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>
            
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title mb-0">جامعہ کا نظام تعلیم شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="nizam-taleem">
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" 
                                            value="<?php echo $existingPage ? $existingPage['title'] : 'تعلیم کا نظام'; ?>" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="pageContent" class="form-label">مواد</label>
                                        <textarea name="content" id="pageContent" class="form-control"><?php echo $existingPage ? $existingPage['content'] : ''; ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="status" class="form-label">سٹیٹس</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="1" <?php echo $existingPage && $existingPage['status'] == 1 ? 'selected' : ''; ?>>فعال</option>
                                            <option value="0" <?php echo $existingPage && $existingPage['status'] == 0 ? 'selected' : ''; ?>>غیر فعال</option>
                                        </select>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-5">
                                            <i class="fas fa-save me-2"></i>محفوظ کریں
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('pageContent', {
                contentsLangDirection: 'rtl',
                height: 500,
                removeButtons: 'Save',
                allowedContent: true,
                language: 'ar'
            });

            $('#addPageForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.set('content', CKEDITOR.instances.pageContent.getData());

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success) {
                            alert('صفحہ کامیابی سے محفوظ ہو گیا ہے');
                            window.location.href = 'index.php';
                        } else {
                            alert(response.error || 'کچھ غلطی ہو گئی ہے');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('ایک خرابی پیش آ گئی: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html> 