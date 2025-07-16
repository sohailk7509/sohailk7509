<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جامعہ کا نظم ونسق شامل کریں</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
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
                                <h3 class="card-title mb-0">جامعہ کا نظم ونسق شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="nazm">
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" value="جامعہ کا نظم ونسق" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="content" class="form-label">مواد</label>
                                        <textarea name="content" id="editor" class="form-control" rows="15"></textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="status" class="form-label">سٹیٹس</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="1">فعال</option>
                                            <option value="0">غیر فعال</option>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize CKEditor
            CKEDITOR.replace('editor', {
                contentsLangDirection: 'rtl',
                height: 500,
                removeButtons: 'Save',
                allowedContent: true
            });

            // Form submission
            $('#addPageForm').on('submit', function(e) {
                e.preventDefault();
                
                // Update CKEditor content
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var formData = new FormData(this);
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success) {
                            alert('صفحہ کامیابی سے محفوظ ہو گیا');
                            window.location.href = 'index.php';
                        } else {
                            alert(response.error || 'کچھ غلطی ہو گئی');
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