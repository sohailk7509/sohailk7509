<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();


// Fetch current content
$sql = "SELECT * FROM pages WHERE page_id = 'hazrat-banori' LIMIT 1";
$result = $db->query($sql);
$page = $result->fetch_assoc();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">حضرت مولانا محمد یوسف بنوری کا صفحہ ترمیم کریں</h3>
                </div>
                <div class="card-body">
                    <form action="actions/update_page.php" method="POST" id="editPageForm">
                        <input type="hidden" name="page_id" value="hazrat-banori">
                        
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>مواد</label>
                            <textarea id="pageContent" name="content" class="form-control editor" rows="20"><?php echo htmlspecialchars($page['content']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>حیثیت</label>
                            <select class="form-control" name="status">
                                <option value="1" <?php echo $page['status'] == 1 ? 'selected' : ''; ?>>فعال</option>
                                <option value="0" <?php echo $page['status'] == 0 ? 'selected' : ''; ?>>غیر فعال</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">محفوظ کریں</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize CKEditor with RTL support
    CKEDITOR.replace('pageContent', {
        contentsLangDirection: 'rtl',
        height: 500,
        removeButtons: 'Save',
        allowedContent: true
    });

    // Form submission handling
    $('#editPageForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('content', CKEDITOR.instances.pageContent.getData());

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    toastr.success('صفحہ کامیابی سے اپ ڈیٹ ہو گیا');
                } else {
                    toastr.error('کچھ غلطی ہو گئی');
                }
            }
        });
    });
});
</script> 