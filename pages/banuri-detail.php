<?php
require_once 'admin/config/db.php';

// Initialize variables
$article = null;
$error = null;

// Check for ID
if(!isset($_GET['id'])) {
    $error = 'مضمون کی شناخت موجود نہیں';
} else {
    $id = $_GET['id'];
    
    // Get article details
    try {
        if($id == 'smartphone' || $id == 'internet' || $id == 'ramadan' || $id == 'hazrat-banuri' || $id == 'sunnat' || $id == 'madaris' || $id == 'ulama' || $id == 'islam') {
            // For category based articles
            $stmt = $db->prepare("SELECT * FROM bayanat WHERE category = ? ORDER BY created_at DESC LIMIT 1");
            $stmt->execute([$id]);
        } else {
            // For specific article
            $stmt = $db->prepare("SELECT * FROM bayanat WHERE id = ?");
            $stmt->execute([$id]);
        }
        
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$article) {
            $error = 'مضمون نہیں ملا';
        }
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        $error = 'ڈیٹابیس میں خرابی';
    }
}
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 magazine_div">
                <div class="col-md-12">
                    <?php if($error): ?>
                        <div class="alert alert-warning">
                            <?php echo $error; ?>
                            <br>
                            <a href="?page=bayanat&id=hazrat-banuri" class="btn btn-link">واپس جائیں</a>
                        </div>
                    <?php elseif($article): ?>
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        
                        <div class="share_print">
                            <div class="bayan_info">
                                <ul>
                                    <li>
                                        <div class="dt_text">
                                            <a href="javascript:"><?php echo htmlspecialchars($article['created_at']); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dt_text">
                                            <a href="javascript:"><?php echo htmlspecialchars($article['author']); ?></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="share_right">
                                <ul>
                                    <?php if(!empty($article['pdf_url'])): ?>
                                    <li>
                                        <div class="dt_text">
                                            <a href="<?php echo htmlspecialchars($article['pdf_url']); ?>" target="_blank" rel="nofollow">پی ڈی ایف</a>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <li>
                                        <div class="dt_text">
                                            <a href="javascript:" onclick="window.print()">صفحہ پرنٹ کریں</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="abt-listning">
                            <h1 style="text-align:center;"><?php echo htmlspecialchars($article['title']); ?></h1>
                            <div class="article-content" style="text-align:justify;">
                                <?php echo $article['content']; ?>
                            </div>
                        </div>
                        
                        <div class="border-top">
                            <div class="share_print">
                                <div class="bayan_info">
                                    <ul>
                                        <li>
                                            <div class="dt_text">
                                                <a href="javascript:"><?php echo htmlspecialchars($article['created_at']); ?></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dt_text">
                                                <a href="javascript:"><?php echo htmlspecialchars($article['author']); ?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="share_right">
                                    <ul>
                                        <?php if(!empty($article['pdf_url'])): ?>
                                        <li>
                                            <div class="dt_text">
                                                <a href="<?php echo htmlspecialchars($article['pdf_url']); ?>" target="_blank" rel="nofollow">پی ڈی ایف</a>
                                            </div>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <div class="dt_text">
                                                <a href="javascript:" onclick="window.print()">صفحہ پرنٹ کریں</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sidebar -->
           
        </div>
    </div>
</section>

<style>
/* Main content styles */
.inner-section {
    padding: 40px 0;
    background: #f8f9fa;
}

.magazine_div {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

/* Title styles */
h3, h1 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
}

/* Info section styles */
.share_print {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.bayan_info ul, .share_right ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
}

.bayan_info li, .share_right li {
    margin-left: 20px;
}

/* Link styles */
.dt_text a {
    color: #34495e;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-size: 15px;
}

.dt_text a:hover {
    background: #edf2f7;
    color: #2c3e50;
}

/* PDF and Print button styles */
.share_right .dt_text a {
    display: inline-block;
    background: #edf2f7;
    color: #2c3e50;
    padding: 8px 20px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.share_right .dt_text a:hover {
    background: #2c3e50;
    color: #fff;
}

/* Article content styles */
.article-content {
    line-height: 1.8;
    color: #2c3e50;
    font-size: 16px;
    margin-top: 30px;
}

.article-content p {
    margin-bottom: 20px;
}

/* Border styles */
.border-top {
    border-top: 1px solid #edf2f7;
    margin-top: 40px;
    padding-top: 20px;
}

/* Alert styles */
.alert {
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
}

.btn-link {
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s;
    font-weight: 500;
}

.btn-link:hover {
    color: #2980b9;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .magazine_div {
        padding: 20px;
    }
    
    .bayan_info ul, .share_right ul {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .bayan_info li, .share_right li {
        margin: 5px 0;
    }
}
</style> 