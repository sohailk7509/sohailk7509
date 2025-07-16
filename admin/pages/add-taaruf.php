<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Introduction Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border: none;
            margin-top: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
        }
        .card-title {
            color: #333;
            font-size: 1.25rem;
            margin: 0;
        }
        .card-body {
            padding: 20px;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .form-control {
            border: 1px solid #ddd;
            padding: 8px 12px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
            padding: 10px 25px;
        }
        .btn-primary:hover {
            background-color: #004494;
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
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-plus-circle me-2"></i>Add Introduction Page
                                </h3>
                            </div>
                            <div class="card-body">
                                <form id="addPageForm" action="actions/add_page.php" method="POST">
                                    <input type="hidden" name="page_id" value="taaruf">
                                    
                                    <div class="form-group mb-4">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" required 
                                               placeholder="Enter page title">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label">Content</label>
                                        <textarea id="pageContent" name="content" class="form-control editor" 
                                                  rows="20" placeholder="Enter page content"></textarea>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Page
                                        </button>
                                        <a href="index.php" class="btn btn-secondary ms-2">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </a>
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
        CKEDITOR.replace('pageContent', {
            contentsLangDirection: 'rtl',
            height: 500,
            removeButtons: 'Save',
            allowedContent: true
        });

        $('#addPageForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('content', CKEDITOR.instances.pageContent.getData());

            $.ajax({
                url: 'actions/add_page.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success) {
                        alert('Page added successfully');
                        window.location.href = 'index.php';
                    } else {
                        alert(response.error || 'Error adding page');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
    </script>
</body>
</html> 