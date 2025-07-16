<?php
require_once 'admin/config/db.php';

// Get all books from database
try {
    $stmt = $db->query("SELECT * FROM books ORDER BY category, created_at DESC");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Group books by category
    $grouped_books = [];
    foreach($books as $book) {
        $category = $book['category'];
        if(!isset($grouped_books[$category])) {
            $grouped_books[$category] = [];
        }
        $grouped_books[$category][] = $book;
    }
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $error = 'ڈیٹابیس میں خرابی';
}

// Category names in Urdu
$category_names = [
    'quran' => 'متعلقات قرآن وتفسیر',
    'hadith' => 'متعلقات حدیث واصول حدیث',
    'dua' => 'ادعیہ واذکار',
    'seerat' => 'سیرت رسول صلی اللہ علیہ وسلم',
    'history' => 'تاریخ وسوانح',
    'fiqh' => 'فقہ وفتاوی',
    'articles' => 'مقالات ومضامین',
    'dawat' => 'دعوت وارشاد',
    'arabic' => 'لغت وادب عربی',
    'tarbiyat' => 'تربیت واصلاح معاشرہ',
    'tibb' => 'طب'
];
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <!-- Books Section -->
                <h3>کتابیں</h3>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php else: ?>
                    <?php 
                    // Get books only
                    $stmt = $db->query("SELECT * FROM books WHERE type = 'book' ORDER BY category, created_at DESC");
                    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Group books by category
                    $grouped_books = [];
                    foreach($books as $book) {
                        $category = $book['category'];
                        if(!isset($grouped_books[$category])) {
                            $grouped_books[$category] = [];
                        }
                        $grouped_books[$category][] = $book;
                    }
                    
                    foreach($grouped_books as $category => $cat_books): ?>
                        <h4><?php echo $category_names[$category]; ?></h4>
                        <ol>
                            <?php foreach($cat_books as $book): ?>
                                <li>
                                    <?php echo htmlspecialchars($book['title']); ?>
                                    <?php if(!empty($book['author'])): ?>
                                        / <?php echo htmlspecialchars($book['author']); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- PDF Files Section -->
                <div class="pdf-section">
                    <h3>PDF فائلیں</h3>
                    <?php
                    // Get PDF files grouped by category
                    $stmt = $db->query("SELECT * FROM books WHERE type = 'pdf' ORDER BY category, created_at DESC");
                    $pdfs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Group PDFs by category
                    $grouped_pdfs = [];
                    foreach($pdfs as $pdf) {
                        $category = $pdf['category'];
                        if(!isset($grouped_pdfs[$category])) {
                            $grouped_pdfs[$category] = [];
                        }
                        $grouped_pdfs[$category][] = $pdf;
                    }
                    
                    if(!empty($grouped_pdfs)): ?>
                        <?php foreach($grouped_pdfs as $category => $category_pdfs): ?>
                            <div class="pdf-category">
                                <h4><?php echo $category_names[$category]; ?></h4>
                                <div class="row">
                                    <?php foreach($category_pdfs as $pdf): ?>
                                        <div class="col-md-6">
                                            <div class="pdf-item">
                                                <a href="<?php echo htmlspecialchars($pdf['pdf_url']); ?>" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <div>
                                                        <p class="pdf-title"><?php echo htmlspecialchars($pdf['title']); ?></p>
                                                        <?php if(!empty($pdf['author'])): ?>
                                                            <p class="pdf-author"><?php echo htmlspecialchars($pdf['author']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="download-btn">
                                                        <i class="fas fa-download"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">کوئی PDF فائل دستیاب نہیں ہے</p>
                    <?php endif; ?>
                </div>
            </div>
            
           
        </div>
    </div>
</section>

<style>
.pdf-section {
    margin-top: 40px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.pdf-section h3 {
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e74c3c;
    text-align: center;
}

.pdf-item {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #eee;
    position: relative;
    overflow: hidden;
}

.pdf-item:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: #e74c3c;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.pdf-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    border-color: #e74c3c;
}

.pdf-item:hover:before {
    opacity: 1;
}

.pdf-item a {
    display: flex;
    align-items: center;
    color: #2c3e50;
    text-decoration: none;
    padding: 5px;
}

.pdf-item .fa-file-pdf {
    color: #e74c3c;
    font-size: 32px;
    margin-left: 20px;
    transition: transform 0.3s ease;
}

.pdf-item:hover .fa-file-pdf {
    transform: scale(1.1);
}

.pdf-item .pdf-title {
    font-size: 18px;
    margin: 0;
    font-weight: 500;
    line-height: 1.4;
}

.pdf-item .pdf-author {
    color: #7f8c8d;
    font-size: 14px;
    margin: 5px 0 0 0;
    opacity: 0.8;
}

.pdf-category {
    margin-bottom: 40px;
}

.pdf-category h4 {
    color: #34495e;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 1px solid #bdc3c7;
    text-align: center;
    font-size: 20px;
    position: relative;
}

.pdf-category h4:after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 2px;
    background: #e74c3c;
}

/* Add download button style */
.pdf-item .download-btn {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.pdf-item:hover .download-btn {
    opacity: 1;
}

.download-btn i {
    color: #e74c3c;
    font-size: 20px;
}
</style> 