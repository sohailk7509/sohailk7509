<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    
    // Handle content based on type
    if($type === 'pdf') {
        $content = ''; // No content needed for PDF
        
        // PDF file is required for PDF type
        if(!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] != 0) {
            $_SESSION['error'] = "PDF فائل اپلوڈ کرنا ضروری ہے";
            $pdf_url = "";
            goto end;
        }
        
        $allowed = array('pdf');
        $filename = $_FILES['pdf_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(in_array($ext, $allowed)) {
            $upload_path = "../../uploads/books/";
            
            // Create directory if it doesn't exist
            if(!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
            
            $new_filename = time() . '_' . $filename;
            $destination = $upload_path . $new_filename;
            
            if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $destination)) {
                $pdf_url = "uploads/books/" . $new_filename;
            } else {
                $_SESSION['error'] = "فائل اپلوڈ نہیں ہو سکی";
                $pdf_url = "";
            }
        } else {
            $_SESSION['error'] = "صرف PDF فائل اپلوڈ کر سکتے ہیں";
            $pdf_url = "";
        }
    } else {
        $content = $_POST['content'];
        $pdf_url = ""; // No PDF for regular books
    }
    
    end:
    try {
        $stmt = $db->prepare("INSERT INTO books (title, author, category, content, pdf_url, type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $category, $content, $pdf_url, $type]);
        $_SESSION['success'] = "کتاب کامیابی سے شامل کر دی گئی";
        header("Location: index.php");
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}
?>

<?php require_once '../includes/header.php'  ?>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <?php include '../includes/sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <?php include '../includes/navbar.php'; ?>

        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">نئی کتاب شامل کریں</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>مصنف</label>
                                            <input type="text" name="author" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>زمرہ</label>
                                            <select name="category" class="form-control" required>
                                                <option value="quran">متعلقات قرآن وتفسیر</option>
                                                <option value="hadith">متعلقات حدیث واصول حدیث</option>
                                                <option value="dua">ادعیہ واذکار</option>
                                                <option value="seerat">سیرت رسول صلی اللہ علیہ وسلم</option>
                                                <option value="history">تاریخ وسوانح</option>
                                                <option value="fiqh">فقہ وفتاوی</option>
                                                <option value="articles">مقالات ومضامین</option>
                                                <option value="dawat">دعوت وارشاد</option>
                                                <option value="arabic">لغت وادب عربی</option>
                                                <option value="tarbiyat">تربیت واصلاح معاشرہ</option>
                                                <option value="tibb">طب</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>قسم</label>
                                            <select name="type" class="form-control" id="contentType" required>
                                                <option value="book">کتاب</option>
                                                <option value="pdf">PDF فائل</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="contentSection">
                                        <div class="form-group">
                                            <label>متن</label>
                                            <textarea name="content" id="content" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="pdfUploadSection" style="display:none;">
                                        <div class="form-group">
                                            <label>PDF فائل اپلوڈ کریں</label>
                                            <input type="file" name="pdf_file" class="form-control" accept=".pdf" id="pdfFile">
                                            <small class="text-muted">صرف PDF فائل اپلوڈ کر سکتے ہیں</small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-3">محفوظ کریں</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    CKEDITOR.replace('content');
    
    document.getElementById('contentType').addEventListener('change', function() {
        var contentSection = document.getElementById('contentSection');
        var uploadSection = document.getElementById('pdfUploadSection');
        var pdfFile = document.getElementById('pdfFile');
        
        if(this.value === 'pdf') {
            contentSection.style.display = 'none';
            uploadSection.style.display = 'block';
            pdfFile.required = true;
            CKEDITOR.instances.content.setData(''); // Clear content
        } else {
            contentSection.style.display = 'block';
            uploadSection.style.display = 'none';
            pdfFile.required = false;
        }
    });
</script>
</body>
</html> 