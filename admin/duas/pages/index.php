<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

$sql = "SELECT * FROM pages ORDER BY created_at DESC";
$stmt = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex" id="wrapper">
    <?php include '../includes/sidebar.php'; ?>
    <div id="page-content-wrapper">
        <?php include '../includes/navbar.php'; ?>
        <div class="container-fluid px-4">
            <div class="row g-3 my-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pages List</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
                                <i class="fas fa-plus me-2"></i>Add New Page
                            </button>
                        </div>
                        <div class="card-body">
                            <?php if(isset($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php 
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="pagesTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1;
                                        while($page = $stmt->fetch(PDO::FETCH_ASSOC)): 
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo htmlspecialchars($page['title']); ?></td>
                                            <td>
                                                <?php if($page['status'] == 1): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date('d M Y h:i A', strtotime($page['created_at'])); ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-info edit-page" data-id="<?php echo $page['id']; ?>" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-page" data-id="<?php echo $page['id']; ?>" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Page Modal -->
<div class="modal fade" id="addPageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addPageForm">
                    <div class="form-group mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Content</label>
                        <textarea id="pageContent" name="content" class="form-control editor" rows="20"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePageBtn">Save Page</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#pagesTable').DataTable({
        "order": [[3, "desc"]], // Sort by created_at by default
        "pageLength": 10,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "search": "Search:",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        }
    });

    // Initialize CKEditor
    CKEDITOR.replace('pageContent', {
        contentsLangDirection: 'rtl',
        height: 300,
        removeButtons: 'Save',
        allowedContent: true
    });

    // Handle form submission
    $('#addPageForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('content', CKEDITOR.instances.pageContent.getData());
        
        // Get the page_id from the hidden input
        var pageId = $('input[name="page_id"]').val();
        
        $.ajax({
            url: 'actions/add_page.php',  // Fixed URL
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