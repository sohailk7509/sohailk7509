<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();
?>

<?php require_once '../includes/header.php'  ?>
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <div class="d-flex" id="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>
            
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title mb-0">طریقہ تعاون شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="donations">
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" value="طریقہ تعاون" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="content" class="form-label">مواد</label>
                                        <textarea name="content" id="editor" class="form-control" rows="15"></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="bank_details" class="form-label">بینک اکاؤنٹس کی تفصیلات</label>
                                        <div id="bankAccounts">
                                            <div class="bank-account mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="bank_name[]" class="form-control mb-2" placeholder="بینک کا نام" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="account_title[]" class="form-control mb-2" placeholder="اکاؤنٹ ٹائٹل" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="account_no[]" class="form-control mb-2" placeholder="اکاؤنٹ نمبر" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="iban[]" class="form-control mb-2" placeholder="IBAN" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="branch_name[]" class="form-control mb-2" placeholder="برانچ کا نام" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="branch_code[]" class="form-control mb-2" placeholder="برانچ کوڈ" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="swift_code[]" class="form-control mb-2" placeholder="Swift Code" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary" id="addBank">
                                            <i class="fas fa-plus"></i> مزید بینک شامل کریں
                                        </button>
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

            // Add new bank account form
            $('#addBank').click(function() {
                var bankHtml = $('.bank-account:first').clone();
                bankHtml.find('input').val('');
                $('#bankAccounts').append(bankHtml);
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