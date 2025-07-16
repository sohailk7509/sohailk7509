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
    <title>رابطہ شامل کریں</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <style>
        .contact-form .form-control {
            margin-bottom: 15px;
        }
        .contact-table-preview {
            border: 1px solid #ddd;
            margin: 20px 0;
            width: 100%;
        }
        .contact-table-preview th, .contact-table-preview td {
            padding: 10px;
            border: 1px solid #ddd;
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
                                <h3 class="card-title mb-0">رابطہ شامل کریں</h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="contact">
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" name="title" id="title" class="form-control" value="رابطہ" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">فون نمبرز</label>
                                        <div class="phone-inputs">
                                            <input type="text" class="form-control mb-2 phone-input" placeholder="فون نمبر">
                                            <button type="button" class="btn btn-sm btn-secondary add-phone">
                                                <i class="fas fa-plus"></i> مزید فون نمبر شامل کریں
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">ای میلز</label>
                                        <div class="email-inputs">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control email-label" placeholder="لیبل">
                                                <input type="email" class="form-control email-input" placeholder="ای میل">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-secondary add-email">
                                                <i class="fas fa-plus"></i> مزید ای میل شامل کریں
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">چھٹی کا دن</label>
                                        <input type="text" id="holiday" class="form-control" value="جمعہ">
                                    </div>

                                    <input type="hidden" name="content" id="pageContent">
                                    
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
    <script>
        $(document).ready(function() {
            // Add phone number field
            $('.add-phone').click(function() {
                $('.phone-inputs').prepend(`
                    <div class="input-group mb-2">
                        <input type="text" class="form-control phone-input" placeholder="فون نمبر">
                        <button type="button" class="btn btn-danger remove-field">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `);
            });

            // Add email field
            $('.add-email').click(function() {
                $('.email-inputs').prepend(`
                    <div class="input-group mb-2">
                        <input type="text" class="form-control email-label" placeholder="لیبل">
                        <input type="email" class="form-control email-input" placeholder="ای میل">
                        <button type="button" class="btn btn-danger remove-field">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `);
            });

            // Remove field
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.input-group').remove();
            });

            // Form submission
            $('#addPageForm').on('submit', function(e) {
                e.preventDefault();

                // Collect data
                let phones = [];
                $('.phone-input').each(function() {
                    if($(this).val()) {
                        phones.push($(this).val());
                    }
                });

                let emails = {};
                $('.email-inputs .input-group').each(function() {
                    let label = $(this).find('.email-label').val();
                    let email = $(this).find('.email-input').val();
                    if(label && email) {
                        emails[label] = email;
                    }
                });

                // Create JSON content
                let content = {
                    phones: phones,
                    emails: emails,
                    holiday: $('#holiday').val()
                };

                // Set content to hidden input
                $('#pageContent').val(JSON.stringify(content));

                // Submit form
                var formData = new FormData(this);
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success) {
                            alert('رابطہ کی معلومات کامیابی سے محفوظ ہو گئیں');
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