<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();
?>


<?php require_once '../includes/header.php'  ?>
    <div class="d-flex" id="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>
            
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title mb-0">حضرت بنوری رحمہ اللہ کا صفحہ شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="hazrat-banori">
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="pageContent" class="form-label">مواد</label>
                                        <textarea name="content" id="pageContent" class="form-control"></textarea>
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
                            alert('صفحہ کامیابی سے شامل کر دیا گیا ہے');
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