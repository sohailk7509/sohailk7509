<?php include 'header/mainheader.php'; ?>
<?php include 'header/header.php'; ?>
<?php include 'header/header-point.php'; ?>
<?php require_once 'admin/config/db.php'; ?>

<?php 
if (isset($_GET['page']) && $_GET['page'] == 'hazrat-banori') {

    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['hazrat-banori']);
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    $page_id = 'hazrat-banori';
    include 'pages/hazrat-banori.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'nizam-taleem') {
    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['nizam-taleem']);
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    $page_id = 'nizam-taleem';
    include 'pages/nizam-taleem.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'contact') {
    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['contact']);
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    $page_id = 'contact';
    include 'pages/contact.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'taaruf') {
 
    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['taaruf']);
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    $page_id = 'taaruf'; 
    include 'pages/taaruf.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'donations') {
   
    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = 'donations' AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute();
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-push-3">
                    <div class="inner-head">
                        <div class="para">
                            <p>طریقہ تعاون</p>
                        </div>
                    </div>
                    <div class="content-area">
                        <?php if($page): ?>
                            <?php echo $page['content']; ?>
                        
                            <div class="row custom-row">
                                <section class="name-results contact-table">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="bank-name">Allied Bank</div>
                                        </div>
                                        <div class="col-md-12">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:40%">Title</td>
                                                        <td><b>JAMIAT UL ULOOM ISLAMIA</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:40%">Account No</td>
                                                        <td><b>0010010964730016</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:40%">IBAN</td>
                                                        <td><b>PK98 ABPA 0010 0109 6473 0016</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:40%">Branch Name</td>
                                                        <td><b>Allied Bank Ltd. - Banuri Town Branch</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <p>معلومات دستیاب نہیں ہیں۔</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-pull-9">
                    <div class="side-menu">
                        <h3><i class="icon-mazameen-icon"></i>معلوماتی لنکس</h3>
                        <ul class="page-links">
                            <li><a href="?page=taaruf">تعارف</a></li>
                            <li><a href="?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a></li>
                            <li><a href="?page=muqaddama">مقدمہ از بانی جامعہ</a></li>
                            <li><a href="?page=jamia-tasis">جامعہ کی تاسیس</a></li>
                            <li><a href="?page=aghraz">جامعہ کے اغراض و مقاصد</a></li>
                            <li><a href="?page=nazm">جامعہ کا نظم ونسق</a></li>
                            <li><a href="?page=nizam-taleem">جامعہ کا نظام تعلیم</a></li>
                            <li class="active"><a href="?page=donations">طریقہ تعاون</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    .content-area {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .content-area p {
        text-align: justify;
        margin-bottom: 15px;
        line-height: 1.8;
    }

    .bank-name {
        font-size: 24px;
        font-weight: bold;
        color: #3c2f1b;
        padding: 20px;
        margin: 20px 0;
        text-align: center;
        border-bottom: 2px solid #b3997d;
    }

    .contact-table table {
        width: 100%;
        margin: 20px 0;
        border: 1px solid #ddd;
    }

    .contact-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .contact-table img {
        max-width: 200px;
        margin: 20px 0;
    }
    </style>

    <?php
} elseif (isset($_GET['page']) && $_GET['page'] == 'nazm') {
    // Get nazm page content
    $stmt = $db->prepare("SELECT * FROM pages WHERE page_id = 'nazm' AND status = 1 ORDER BY created_at DESC LIMIT 1");
    $stmt->execute();
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-push-3">
                    <div class="inner-head">
                        <div class="para">
                            <p>جامعہ کا نظم ونسق</p>
                        </div>
                    </div>
                    <div class="content-area">
                        <?php if($page): ?>
                            <?php echo $page['content']; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <p>معلومات دستیاب نہیں ہیں۔</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-pull-9">
                    <div class="side-menu">
                        <h3><i class="icon-mazameen-icon"></i>معلوماتی لنکس</h3>
                        <ul class="page-links">
                            <li><a href="?page=taaruf">تعارف</a></li>
                            <li><a href="?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a></li>
                            <li><a href="?page=muqaddama">مقدمہ از بانی جامعہ</a></li>
                            <li><a href="?page=jamia-tasis">جامعہ کی تاسیس</a></li>
                            <li><a href="?page=aghraz">جامعہ کے اغراض و مقاصد</a></li>
                            <li class="active"><a href="?page=nazm">جامعہ کا نظم ونسق</a></li>
                            <li><a href="?page=nizam-taleem">جامعہ کا نظام تعلیم</a></li>
                            <li><a href="?page=donations">طریقہ تعاون</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    .content-area {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .content-area p {
        text-align: justify;
        margin-bottom: 15px;
        line-height: 1.8;
    }
    </style>

    <?php
} elseif (isset($_GET['page']) && $_GET['page'] == 'new-questions') {
    // Get questions from database
    $stmt = $db->prepare("SELECT * FROM questions WHERE status = 'published' ORDER BY created_at DESC");
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include 'pages/new-questions.php';

} elseif (isset($_GET['page']) && $_GET['page'] == 'masla-poochain') {
    include 'pages/masla-poochain.php';

} elseif (isset($_GET['page']) && $_GET['page'] == 'khwab-ki-tabeer') {
    include 'pages/khwab-ki-tabeer.php';

} elseif (isset($_GET['page']) && $_GET['page'] == 'islami-naam') {
    include 'pages/islami-naam.php';

} elseif (isset($_GET['page']) && $_GET['page'] == 'namaz-times') {
    $pageTitle = "نماز کے اوقات";
    include 'pages/namaz-times.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'bayanat' && isset($_GET['id']) && $_GET['id'] == 'hazrat-banuri') {
    include 'pages/bayanat-hazrat-banuri.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'banuri-detail') {
    include 'pages/banuri-detail.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'books') {
    include 'pages/books.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'dua') {
    
    try {
        $stmt = null;

        if(isset($_GET['category'])) {
           
            $stmt = $db->prepare("SELECT d.*, c.name as category_name 
                                FROM duas d 
                                JOIN dua_categories c ON d.category = c.slug 
                                WHERE d.category = ? AND d.status = 1 
                                ORDER BY d.id DESC LIMIT 1");
            $stmt->execute([$_GET['category']]);
            $dua = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
           
            $stmt = $db->prepare("SELECT d.*, c.name as category_name 
                                FROM duas d 
                                JOIN dua_categories c ON d.category = c.slug 
                                WHERE d.status = 1 
                                ORDER BY d.id DESC LIMIT 1");
            $stmt->execute();
            $dua = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $cat_stmt = $db->query("SELECT * FROM dua_categories ORDER BY name ASC");
        $categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        $dua = null;
        $categories = [];
    }
    
    include 'pages/dua.php';
} elseif (isset($_GET['page']) && $_GET['page'] == 'dua-detail') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    try {
       
        $stmt = $db->prepare("SELECT d.*, c.name as category_name 
                             FROM duas d 
                             LEFT JOIN dua_categories c ON d.category = c.slug 
                             WHERE d.id = ?");
        $stmt->execute([$id]);
        $dua = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($dua) {
           
            $stmt = $db->prepare("UPDATE duas SET views = views + 1 WHERE id = ?");
            $stmt->execute([$id]);
            
            include 'pages/dua-detail.php';
        } else {
            include 'pages/404.php';
        }
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        include 'pages/404.php';
    }
} else {
   
?>

<!-- Main Slider Section -->
<section class="main-slider">
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.banuri.edu.pk/assets/uploads/2018/02/x2018___02___6671_desktop_banner2.jpeg.pagespeed.ic.gTkhq_x_z4.webp" class="d-block w-100" alt="جامعہ علوم اسلامیہ بنوری ٹاؤن">
            </div>
        </div>
        <div class="slider-nav">
            <button class="nav-btn prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="nav-btn next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- News Ticker Section -->
<div class="news-ticker">
    <div class="container">
        <div class="ticker-content">
            <p class="mb-0 text-center">
                اعلان برائے قیام فارم دارالافتاء و سیمینار برائے مسئلہ سود
            </p>
        </div>
    </div>
</div>

<!-- Featured Boxes Section -->
<section class="featured-boxes py-5">
<img class="vector-bg" src="https://taqwa.nauthemes.net/wp-content/uploads/2020/04/bg-vector-2-1.png" alt="" itemprop="image">
    <div class="container">
        <div class="row g-4">
            <!-- Box 1: Darul Ifta -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="دارالافتاء" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>دارالافتاء</h3>
                            <p>آپ کے مسائل اور ان کا حل</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box 2: Taaruf Jamia -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="تعارف جامعہ" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>تعارف جامعہ بنوری ٹاؤن</h3>
                            <p>جامعہ اور اس کی تاریخ ایک نظر میں</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box 3: Bani Jamia -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="بانی جامعہ" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>بانی جامعہ حضرت بنوری رحمہ اللہ</h3>
                            <p>تعارف، علمی و تحقیقی خدمات</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box 4: Rabta -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="رابطہ" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>رابطہ</h3>
                            <p>برائے معلومات</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box 5: Kutub -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="کتابیں" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>کتابیں</h3>
                            <p>مصنفہ شیخ الاسلام کتابیں</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box 6: Mahnama -->
            <div class="col-md-4">
                <a href="#" class="featured-box">
                    <div class="box-content">
                        <div class="icon-wrapper">
                            <img src="data:image/webp;base64,UklGRpAEAABXRUJQVlA4TIQEAAAvSUASEMekoG0byYyOP73rPgiTMyUM27YNm6skt5vatm0YZOrhHThvwCUgABABANAnTBasPggJIhheMoRARCiOOWtzkRVqmcNyac6WOoYwCDGIIB5+CCHBtm1Dkk4w0bZt27aRatu2bZtvvvH/+z8icgAR/Yfgto0kyU72amxB3VOVSvUTKMLJrbsp3eHkncjHtGtS5EPaDflWDL9LKNvxG5EuieiZKH4TU6bDR6L6VZkR3hWHn0fl5Q1x+mlZMeCNePhRQReD6fOWLFmyasOGlYtnTR6/8Kr4+efGObNmLV5ie0bgp1Hi73PnciAt9tNEf8qDcMifaUex2g9w0BtqXaHqYPhAF+gAlg+VrkNA5d37KnCkSHlfTT+LfKkA+0rQjUa702i0Tp1qjszyo4jIpxQY2Tx1qtFotA40zhekT666+F4Mv3cVs9vF6K67UvvVxQvFKe1RNzzc+NmK4XXTFeBmMXoFPSWna3A3nybYNRkGicPtPeJwb7iWT+P81YINLuX+8xpNvXXe29bKcuiTtoZ9Np1vmvrovMMA+rgU2gi/fUpucEPcv8xJq2OvG3cOicjJkb16LLDEf7FnWOjM8JZyp49t1QAWydBspKrMzEZKbV0X7wjvieKF0M8AqBpI843h4tUGRN3WcI3zgR7hQw2ooUzEARges3HFyg2T9bk+Cuio21OkjfZYw9kJRB8MhO0GVFsM7wbs6fsyQhtURJ5EXq3CFiB+pk7SPXqpnWUxvIghOKdu5bGR8UsNZRMQv1Iwluq18ARzFYbXCdDSmF5mEb/WQDYDqdVe3RwSVuqOHXNQWAn6X7aKWwpsFv2Wkreuq+kH7anASl3GoKy1qmcF2KhBvU3uaBCngeCDdjPAEl3WgFvE8JcQOK5R3Vc/r7OZnjl24tm6JgLax/Iu01mN6po+hTvqTNxn0E7VNd5AWWY9xezCTg3qTUJ4X9/mtWX2cESlb62mq1e1Z99Jt9RJsseREN7WWw8HxwId8jgzXL1gQ/3P2F015LDOsR6CMzbRMWDkfzWbeqqVTAcNzTVy1YCaYjaC2wyI/QbD1yw7no1vcE1/eDBBnyPUR8/fORLD402gHAnBFQ1oBfTV6iIzewBEKwC7zPWGOSIi2oeuxyWtOMFAAyAyl1KfbKRYpmYj1Wxd8kjHj86qP65PfWBLpG5gibRH9qqMtHVX1HLkdPTLe3ccBzBYIzF00UL443f22eitBwBXvffZFl4e779jb4KNBe/YY3J0EXu2S8GapHU2tX+Sy/8ruTVL7bbCNDE8VO22fsxJg6RWT5OQ3Jrh2QF+sfN5GR3gRwdNz99i+Jnr+Pa4oE753inbi4HBf5U1PeuExXPiRgnd+0mrhL3NrrZLPlEcN6aAkc3STzlHgXlZ7u2Ck9cRDO+WopXj7LXLG2qjn6aJt9uw059pZ9Gn5lNHciAt9xPTl+je+N2P+PdWB9ycgEIc3vHJlyW91LG28gLewxT7o2Nj7o54W/JLpnsi+ouvsqNbEsL72qm5/HhQ/ptGx8HlYwrdEZcfFpIA" alt="ماہنامہ" class="icon">
                        </div>
                        <div class="text-content">
                            <h3>ماہنامہ بینات</h3>
                            <p>قرآن و سنت کی تبلیغ و تشریح کا خزانہ</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Questions Section -->
<section class="questions-section p-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="questions-container">
                    <nav>
                        <div class="nav nav-tabs questions-header" id="nav-tab" role="tablist">
                            <button class="header-right nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">منتخب سوالات</button>
                            <button class="header-left nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">نئے سوالات</button>
                        </div>
                        
                        <div class="tab-content" id="nav-tabContent">
                            <!-- Featured Questions Tab -->
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row">
                                    <?php
                                    $featured = $db->query("SELECT * FROM featured_questions WHERE type = 'featured' ORDER BY created_at DESC LIMIT 9")->fetchAll();
                                    foreach($featured as $index => $question):
                                        if($index == 0):
                                    ?>
                                    <!-- First Column - Large Question -->
                                    <div class="col-sm-12 col-md-4 animate fadeInUp" data-animation="fadeInUp" data-duration="100">
                                        <div class="tab-box">
                                            <h4>تاریخ: <?php echo date('Y-m-d', strtotime($question['created_at'])); ?></h4>
                                            <h3><?php echo htmlspecialchars($question['title']); ?></h3>
                                            <div class="question-content">
                                                <p><?php echo htmlspecialchars($question['question']); ?></p>
                                                <div class="answer-content" style="display: none;">
                                                    <h5>جواب:</h5>
                                                    <p><?php echo htmlspecialchars($question['answer']); ?></p>
                                                </div>
                                                <a href="question.php?id=<?php echo $question['id']; ?>" class="detail-link" target="_blank">
                                                    <span class="detail-text">تفصیل</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <!-- Media Items Columns -->
                                    <div class="col-sm-6 col-md-4 animate fadeInUp" data-animation="fadeInUp" data-duration="<?php echo ($index + 1) * 100; ?>">
                                        <div class="tab-box">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object lazy" src="<?php echo $question['image'] ? 'uploads/questions/'.$question['image'] : 'image/default.png'; ?>" alt="<?php echo htmlspecialchars($question['title']); ?>">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo htmlspecialchars($question['title']); ?></p>
                                                    <a href="question.php?id=<?php echo $question['id']; ?>" title="تفصیل">
                                                        <i class="fas fa-angle-left"></i>تفصیل
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>

                            <!-- New Questions Tab -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    <?php
                                    $new_questions = $db->query("SELECT * FROM featured_questions WHERE type = 'new' ORDER BY created_at DESC LIMIT 3")->fetchAll();
                                    foreach($new_questions as $index => $question):
                                    ?>
                                    <div class="col-sm-12 col-md-4 animate fadeInUp" data-animation="fadeInUp" data-duration="<?php echo ($index + 1) * 100; ?>">
                                        <div class="tab-box">
                                            <h4>تاریخ: <?php echo date('d-m-Y', strtotime($question['created_at'])); ?></h4>
                                            <h3><?php echo htmlspecialchars($question['title']); ?></h3>
                                            <p style="text-align:justify;"><?php echo substr(htmlspecialchars($question['question']), 0, 150); ?>...</p>
                                            <a href="question.php?id=<?php echo $question['id']; ?>" title="تفصیل">
                                                <i class="fas fa-angle-left"></i>تفصیل
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Links Section -->
<section class="quick-links-section py-5">
    <div class="container">
      <div class="row g-4">
            <div class="col-md-3">
                <a href="#" class="quick-link-card">
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>دارالافتاء</h3>
                    <p>شرعی مسائل کے حل</p>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="quick-link-card">
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>داخلہ</h3>
                    <p>داخلہ کی معلومات</p>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="quick-link-card">
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
          </div>
                    <h3>بینات</h3>
                    <p>تحقیقی مضامین</p>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="quick-link-card">
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>تقویم</h3>
                    <p>اہم تاریخ</p>
                </a>
          </div>
      </div>
    </div>
  </section>

<!-- Latest News Section -->
<section class="latest-news py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>تازہ ترین خبریں</h2>
            <div class="section-divider">
                <span class="line"></span>
                <span class="icon"><i class="fas fa-newspaper"></i></span>
                <span class="line"></span>
            </div>
            <p>جامعہ کی تازہ ترین خبریں اور اعلانات</p>
        </div>
        <div class="row g-4">
            <?php
            $stmt = $db->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 3");
            $news = $stmt->fetchAll();
            
            foreach($news as $item):
                $date = new DateTime($item['created_at']);
            ?>
            <div class="col-md-4">
                <div class="news-card">
                    <div class="news-image">
                        <img src="uploads/news/<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="img-fluid">
                        <div class="news-overlay"></div>
                        <div class="news-date">
                            <div class="date-inner">
                                <span class="day"><?php echo $date->format('d'); ?></span>
                                <span class="month"><?php echo $item['month']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="news-content">
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($item['content'], 0, 100)) . '...'; ?></p>
                        <a href="news.php?id=<?php echo $item['id']; ?>" class="read-more">
                            مزید پڑھیں 
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Prayer Times Section -->
<section class="prayer-times-section py-5 d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="prayer-times-card">
                    <div class="prayer-header">
                        <h2>نماز کے اوقات</h2>
                        <p>20 شوال 1446ھ 19 اپریل 2025 ء کراچی میں نماز کے اوقات</p>
                        </div>
                    <div class="prayer-times">
                        <div class="prayer-time-item">
                            <span class="prayer-name">فجر</span>
                            <span class="prayer-time">04:47</span>
                        </div>
                        <div class="prayer-time-item">
                            <span class="prayer-name">ظہر</span>
                            <span class="prayer-time">12:30</span>
                        </div>
                        <div class="prayer-time-item">
                            <span class="prayer-name">عصر</span>
                            <span class="prayer-time">04:00</span>
                        </div>
                        <div class="prayer-time-item">
                            <span class="prayer-name">مغرب</span>
                            <span class="prayer-time">06:45</span>
                        </div>
                        <div class="prayer-time-item">
                            <span class="prayer-name">عشاء</span>
                            <span class="prayer-time">08:00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="calendar-card">
                    <div class="calendar-header">
                        <h3>اسلامی کیلنڈر</h3>
                    </div>
                    <div class="calendar-content">
                        <div class="hijri-date">
                            <span class="date">20</span>
                            <span class="month">شوال</span>
                            <span class="year">1446</span>
                        </div>
                        <div class="gregorian-date">
                            <span class="date">19</span>
                            <span class="month">اپریل</span>
                            <span class="year">2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Articles and Speeches Section -->
<section class="articles-speeches py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Muntakhab Mazameen Column -->
            <div class="col-md-6">
                <div class="content-section">
                    <div class="header-section">
                        <h2>منتخب مضامین</h2>
                        <div class="section-divider">
                            <span class="line"></span>
                            <span class="icon"><i class="fas fa-book"></i></span>
                            <span class="line"></span>
                        </div>
                        <a href="articles.php" class="view-all">تمام مضامین دیکھیں</a>
                    </div>
                    <div class="content-list">
                        <?php
                        $articles = $db->query("SELECT * FROM speeches WHERE category = 'منتخب مضامین' AND status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
                        foreach($articles as $article):
                        ?>
                        <div class="content-item">
                            <div class="content-box">
                                <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                                <?php if(!empty($article['content'])): ?>
                                <p><?php echo htmlspecialchars(substr(strip_tags($article['content']), 0, 100)) . '...'; ?></p>
                                <?php endif; ?>
                                <a href="article.php?id=<?php echo $article['id']; ?>" class="read-more">
                                    مزید پڑھیں 
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Bayanat Noor Column -->
            <div class="col-md-6">
                <div class="content-section">
                    <div class="header-section">
                        <h2>بیانات نور (اردو میں)</h2>
                        <div class="section-divider">
                            <span class="line"></span>
                            <span class="icon"><i class="fas fa-microphone"></i></span>
                            <span class="line"></span>
                        </div>
                        <a href="speeches.php" class="view-all">تمام بیانات دیکھیں</a>
                    </div>
                    <div class="content-list">
                        <?php
                        $speeches = $db->query("SELECT * FROM speeches WHERE category = 'بیانات نور' AND status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
                        foreach($speeches as $speech):
                        ?>
                        <div class="content-item">
                            <div class="content-box">
                                <h3><?php echo htmlspecialchars($speech['title']); ?></h3>
                                <?php if(!empty($speech['content'])): ?>
                                <p><?php echo htmlspecialchars(substr(strip_tags($speech['content']), 0, 100)) . '...'; ?></p>
                                <?php endif; ?>
                                <a href="speech.php?id=<?php echo $speech['id']; ?>" class="read-more">
                                    مزید پڑھیں 
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Peace Section -->
<section class="peace-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-section">
                    <div class="header-section brown">
                        <h2>سکون و اطمینان</h2>
                    </div>
                    <div class="peace-content">
                        <div class="row g-4">
                            <?php
                            $peace_items = $db->query("SELECT * FROM peace_items WHERE status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
                            foreach($peace_items as $item):
                            ?>
                            <div class="col-md-4">
                                <div class="peace-item">
                                    <div class="peace-image">
                                        <img src="https://propakistani.pk/proproperty/wp-content/uploads/2023/08/ProProperty-Design-Template-1000x560-5.jpg" alt="<?php echo htmlspecialchars($item['title']); ?>" class="img-fluid">
                                    </div>
                                    <div class="peace-text">
                                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                                        <a href="speech.php?id=<?php echo $speech['id']; ?>" class="read-more">
                                            مزید پڑھیں 
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Three Column Section -->
<section class="three-column-section">
    <div class="container">
        <div class="row g-4">
            <!-- Articles Column -->
            <div class="col-md-4">
                <div class="content-box">
                    <div class="header-section">
                        <h2>مقالات</h2>
                    </div>
                    <div class="content-list">
                        <div class="list-item">
                            <div class="item-content">
                                <h3>عیسی المسیح کی شخصیت، روحانیت اور انسانیت</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <div class="placeholder-img"></div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="item-content">
                                <h3>حضرت عمر کی ایک دلچسپ اور عبرت ناک داستان</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <div class="placeholder-img"></div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="item-content">
                                <h3>بنو اسرائیل میں خطبہ کے اثرات اور امیر شریعت کی نوید خوش خبری</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <div class="placeholder-img"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prayer Times Column -->
            <div class="col-md-4">
                <div class="content-box">
                    <div class="header-section">
                        <h2>نماز کے اوقات</h2>
                    </div>
                    <div class="prayer-content">
                        <div class="date-display">
                            <p>20شوال1446-19اپریل2025 کراچی میں نماز کے اوقات</p>
                        </div>
                        <div class="prayer-times">
                            <div class="prayer-row">
                                <span class="prayer-name">فجر</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRjABAABXRUJQVlA4ICQBAACQBgCdASodACAAPp1Gm0qlo6IhqAqosBOJZQDE3AnGVjmaU939OeyzxMxprGWhAL3SQakCE+Yo/QV40SGgAP7+7Ttaev0I/k36Uc/9wmq878Nj/0aI1/42/28JU8RZrglUhVhgm5HrkS387DF2WoD6t+UZEEefoz/kBVGCBB6I81cLP87ra/Qi1AJRUg27fZ7FqKFmKzxjB207rajZv+nnli8dCuejrseC0iRYQzbxpNJII47joMiv2JDj0QlXG7DSurmNTgNGlZIhWokdp1yvLIrHmOj1PvzlYHFShb5THLfkCMfqYNXpSYSmeuschvraGLwdCc7bFBhE5S4knFFn7PTJJIFIfXbKSF01ZeSxPFfo0MSoeRaQuNSDRTa81yFuEYAA" alt="فجر"></span>
                                <span class="prayer-time">04:47</span>
                            </div>
                            <div class="prayer-row">
                                <span class="prayer-name">طلوع</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRjABAABXRUJQVlA4ICQBAACQBgCdASodACAAPp1Gm0qlo6IhqAqosBOJZQDE3AnGVjmaU939OeyzxMxprGWhAL3SQakCE+Yo/QV40SGgAP7+7Ttaev0I/k36Uc/9wmq878Nj/0aI1/42/28JU8RZrglUhVhgm5HrkS387DF2WoD6t+UZEEefoz/kBVGCBB6I81cLP87ra/Qi1AJRUg27fZ7FqKFmKzxjB207rajZv+nnli8dCuejrseC0iRYQzbxpNJII47joMiv2JDj0QlXG7DSurmNTgNGlZIhWokdp1yvLIrHmOj1PvzlYHFShb5THLfkCMfqYNXpSYSmeuschvraGLwdCc7bFBhE5S4knFFn7PTJJIFIfXbKSF01ZeSxPFfo0MSoeRaQuNSDRTa81yFuEYAA" alt="طلوع"></span>
                                <span class="prayer-time">06:06</span>
                            </div>
                            <div class="prayer-row">
                                <span class="prayer-name">زوال</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRhgBAABXRUJQVlA4IAwBAACQBgCdASodACAAPp1InkslpCKhqAgAsBOJbACdMoR5n6bwhm1m4AB79Fo+xvbAzyEpDNbE7U3sCqd5iGUAAP7+q9gbMi5PnT7bn9YA6TtKHRkak6BP5h5TuRaZS8bubp3KYrFjOE9p/yb/ymf+LRlN/dvjeTg7PCVmSIB3Gf03U9sV2JGJrvYpmH13Z6AB7Jr2JSjSI7WbETIe0yhEamYRf1TlpgLmz+mislJMTWBd7x9S3KbvMFsRFho1V0ledUpHhgT/I0/uT6lmy+rhggqiYRBPO6aJO+QU9DGTK2oLIKsL6f5k09DAFhgg2ve586UbJepouLpv+Av5nwOThx7Mdzm3ptf6VNN8WAAA" alt="زوال"></span>
                                <span class="prayer-time">12:31</span>
                            </div>
                            <div class="prayer-row">
                                <span class="prayer-name">عصر</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRiwBAABXRUJQVlA4ICABAACQBgCdASodACAAPp1InUulpCKhqAgAsBOJaACdM1DAAXAM48HSfzp+JmTxpXyRkAk/gRES5wJnwk9tta54AP7+rD+H9/KxHU07F383sPMovT277CJ+iXFT9yC+ANco0RwjDMmzEOBi1Dja8s6FnyKwgOAxFaA5GYiu6cwdZC8xGilFPhiGsuxUj9AYknbwTMKuIFaPZm/k0Hmq+WUfeUtZuyGwOyWqWXn8w5T97IH3Zdg+HTDYAMp2sRluPisRlMFHxdeiXmBvoZzPKyQWkxk3eRTsZ0stS28z2Oy3apWGubYy7WaoLjK84URz3euruIknQxVgEZH0cLiIio3adhWsnLcFbC6VWNxp3h2jCIznd39FOfDCxG8gEw5qYKmVMAA=" alt="عصر"></span>
                                <span class="prayer-time">17:05</span>
                            </div>
                            <div class="prayer-row">
                                <span class="prayer-name">مغرب</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRiwBAABXRUJQVlA4ICABAACQBgCdASodACAAPp1InUulpCKhqAgAsBOJaACdM1DAAXAM48HSfzp+JmTxpXyRkAk/gRES5wJnwk9tta54AP7+rD+H9/KxHU07F383sPMovT277CJ+iXFT9yC+ANco0RwjDMmzEOBi1Dja8s6FnyKwgOAxFaA5GYiu6cwdZC8xGilFPhiGsuxUj9AYknbwTMKuIFaPZm/k0Hmq+WUfeUtZuyGwOyWqWXn8w5T97IH3Zdg+HTDYAMp2sRluPisRlMFHxdeiXmBvoZzPKyQWkxk3eRTsZ0stS28z2Oy3apWGubYy7WaoLjK84URz3euruIknQxVgEZH0cLiIio3adhWsnLcFbC6VWNxp3h2jCIznd39FOfDCxG8gEw5qYKmVMAA=" alt="مغرب"></span>
                                <span class="prayer-time">18:56</span>
                            </div>
                            <div class="prayer-row">
                                <span class="prayer-name">عشاء</span>
                                <span class="prayer-icon"><img src="data:image/webp;base64,UklGRjABAABXRUJQVlA4ICQBAACQBgCdASodACAAPp1Gm0qlo6IhqAqosBOJZQDE3AnGVjmaU939OeyzxMxprGWhAL3SQakCE+Yo/QV40SGgAP7+7Ttaev0I/k36Uc/9wmq878Nj/0aI1/42/28JU8RZrglUhVhgm5HrkS387DF2WoD6t+UZEEefoz/kBVGCBB6I81cLP87ra/Qi1AJRUg27fZ7FqKFmKzxjB207rajZv+nnli8dCuejrseC0iRYQzbxpNJII47joMiv2JDj0QlXG7DSurmNTgNGlZIhWokdp1yvLIrHmOj1PvzlYHFShb5THLfkCMfqYNXpSYSmeuschvraGLwdCc7bFBhE5S4knFFn7PTJJIFIfXbKSF01ZeSxPFfo0MSoeRaQuNSDRTa81yFuEYAA" alt="عشاء"></span>
                                <span class="prayer-time">20:56</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Column -->
            <div class="col-md-4">
                <div class="content-box">
                    <div class="header-section">
                        <h2>کتابیں</h2>
                    </div>
                    <div class="content-list">
                        <div class="list-item">
                            <div class="item-content">
                                <h3>تقدمہ نامہ (پہلی جلد)</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <img src="data:image/webp;base64,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" alt="تقدمہ نامہ">
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="item-content">
                                <h3>پیارا محمد (جلد اول)</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <img src="data:image/webp;base64,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" alt="پیارا محمد">
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="item-content">
                                <h3>پیارا محمد (جلد دوم)</h3>
                                <a href="#" class="read-more">پڑھنے کے لیے کلک کریں <i class="fas fa-chevron-left"></i></a>
                            </div>
                            <div class="thumbnail">
                                <img src="data:image/webp;base64,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" alt="پیارا محمد">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- Footer -->
<?php include 'header/footer.php'; ?>

<style>
/* Add this to your CSS file */
.featured-boxes {
    /* background-color: #fff; */
    padding: 40px 0;
    
}

.featured-box {
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
}

.featured-box:hover {
    transform: translateY(-5px);
}

.box-content {
    
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 25px;
    display: flex;
    align-items: center;
    min-height: 140px;
    transition: all 0.3s ease;
}

.featured-box:hover .box-content {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    margin-left: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color:rgba(170, 122, 159, 0.06);
    border-radius: 50%;
}

.icon-wrapper img {
    width: 100%;
    height: auto;
    max-width: 80px;
    opacity: 0.8;
}

.text-content {
    flex: 1;
}

.text-content h3 {
    color: #333;
    font-size: 18px;
    margin-bottom: 8px;
    font-weight: 600;
}

.text-content p {
    color: #666;
    font-size: 14px;
    margin: 0;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .box-content {
        padding: 20px;
        min-height: 120px;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        margin-left: 15px;
    }
    
    .icon-wrapper img {
        max-width: 35px;
    }
    
    .text-content h3 {
        font-size: 16px;
    }
    
    .text-content p {
        font-size: 13px;
    }
}



.header-section {
    padding: 15px;
    text-align: center;
    transition: all 0.3s ease;
}

.header-section.brown {
    background-color: #8B4513;
    color: #fff;
    border-radius: 8px 8px 0 0;
}

.header-section.light {
    background-color: #f2e6d9;
    color: #333;
    border-radius: 8px 8px 0 0;
}

.header-section .header-link {
    font-size: 22px;
    font-weight: 600;
    text-decoration: none;
    color: inherit;
    display: block;
    padding: 5px;
}

.header-section.brown .header-link:hover {
    color: #FFE4C4;
}

.header-section.light .header-link:hover {
    color: #8B4513;
}


.date {
    color: #8B4513;
    font-size: 14px;
    margin-bottom: 10px;
    text-align: left;
    font-weight: 500;
}

.question-content h3 {
    font-size: 16px;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.6;
    transition: all 0.3s ease;
}

.question-content:hover h3 {
    color: #8B4513;
}

.detail-content {
    background-color: #FFF8F3;
    padding: 20px;
    margin: 15px 0;
    border-radius: 8px;
    border: 1px solid #e0d5cc;
}

.detail-content p {
    margin-bottom: 12px;
    line-height: 1.8;
    color: #555;
    font-size: 15px;
}

.read-more {
    color: #8B4513;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 0;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: #5c2d0c;
    transform: translateX(-5px);
}

.read-more i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(-3px);
}

.border-end {
    border-right: 1px solid #e0d5cc;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .header-section .header-link {
        font-size: 18px;
    }

    .border-end {
        border-right: none;
        border-bottom: 1px solid #e0d5cc;
    }

   

    .detail-content {
        padding: 15px;
    }
}

/* Articles and Speeches Section Styling */
.articles-speeches {
    background-color: #f8f9fa;
    direction: rtl;
}

.content-section {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.header-section {
    background: #3c2f1b;
    padding: 20px;
    text-align: center;
    border-bottom: 4px solid #b3997d;
}

.header-section h2 {
    color: #fff;
    font-size: 1.8rem;
    margin: 0;
}

.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
}

.section-divider .line {
    height: 2px;
    width: 40px;
    background: #b3997d;
}

.section-divider .icon {
    color: #b3997d;
    font-size: 1.2rem;
    margin: 0 10px;
}

.content-list {
    padding: 20px;
}

.content-item {
    margin-bottom: 20px;
}

.content-item:last-child {
    margin-bottom: 0;
}

.content-box {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 20px;
    transition: all 0.3s ease;
}

.content-box:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transform: translateY(-3px);
    border-color: #b3997d;
}

.content-box h3 {
    color: #3c2f1b;
    font-size: 1.2rem;
    margin-bottom: 10px;
    line-height: 1.4;
}

.content-box p {
    color: #666;
    font-size: 1rem;
    margin-bottom: 15px;
    line-height: 1.6;
}

.read-more {
    color: #b3997d;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border-bottom: 2px solid transparent;
}

.read-more:hover {
    color: #3c2f1b;
    border-bottom-color: #b3997d;
}

.read-more i {
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(-5px);
}

@media (max-width: 768px) {
    .header-section h2 {
        font-size: 1.5rem;
    }
    
    .content-box {
        padding: 15px;
    }
    
    .content-box h3 {
        font-size: 1.1rem;
    }
}

/* Peace Section Styling */
.peace-section {
    margin: 30px 0;
}

.peace-content {
    padding: 30px;
}

.peace-item {
    background: #fff;
    border: 1px solid #e0d5cc;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.peace-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.peace-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.peace-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.peace-item:hover .peace-image img {
    transform: scale(1.1);
}

.peace-text {
    padding: 20px;
}

.peace-text h3 {
    color: #4a3426;
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: 600;
}

.peace-text p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.peace-text .read-more {
    color: #8B4513;
    text-decoration: none;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.peace-text .read-more:hover {
    color: #5c2d0c;
    gap: 8px;
}

@media (max-width: 768px) {
    .peace-content {
        padding: 20px;
    }

    .peace-image {
        height: 160px;
    }

    .peace-text {
        padding: 15px;
    }

    .peace-text h3 {
        font-size: 16px;
    }

    .peace-text p {
        font-size: 13px;
    }
}

/* Three Column Section Styling */
.three-column-section {
    margin: 30px 0;
}

.content-box {
    background: #fff;
    border: 1px solid #e0d5cc;
    border-radius: 8px;
    overflow: hidden;
}

.header-section {
    background-color: #4a3426;
    color: #fff;
    padding: 12px 20px;
    text-align: center;
}

.header-section h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 500;
}

.content-list {
    padding: 15px;
}

.list-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e0d5cc;
}

.list-item:last-child {
    border-bottom: none;
}

.item-content {
    flex: 1;
    padding-left: 15px;
}

.item-content h3 {
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
    line-height: 1.4;
}

.read-more {
    color: #8B4513;
    text-decoration: none;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.thumbnail {
    width: 60px;
    height: 60px;
    overflow: hidden;
    border-radius: 4px;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-img {
    width: 100%;
    height: 100%;
    background-color: #f0f0f0;
}

/* Prayer Times Specific Styling */
.prayer-content {
    padding: 15px;
}

.date-display {
    text-align: center;
    color: #333;
    font-size: 14px;
}

.prayer-times {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.prayer-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 15px;
    background-color: #f8f8f8;
    border-radius: 4px;
}

.prayer-name {
    font-size: 14px;
    color: #333;
}

.prayer-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.prayer-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.prayer-time {
    font-size: 14px;
    color: #333;
    direction: ltr;
}

@media (max-width: 768px) {
    .header-section {
        padding: 10px 15px;
    }

    .header-section h2 {
        font-size: 18px;
    }

    .item-content h3 {
        font-size: 13px;
    }

    .thumbnail {
        width: 50px;
        height: 50px;
    }

    .prayer-row {
        padding: 6px 10px;
    }
}

.latest-news {
    background-color: #f8f9fa;
    direction: rtl;
    position: relative;
    overflow: hidden;
}

.section-header {
    position: relative;
    z-index: 1;
}

.section-header h2 {
    color: #3c2f1b;
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-weight: bold;
}

.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0;
}

.section-divider .line {
    height: 2px;
    width: 60px;
    background: #b3997d;
}

.section-divider .icon {
    color: #b3997d;
    font-size: 1.5rem;
    margin: 0 15px;
}

.section-header p {
    color: #666;
    font-size: 1.2rem;
    margin-top: 10px;
}

.news-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.news-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(179, 153, 125, 0.2);
}

.news-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.1);
}

.news-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
}

.news-date {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
}

.date-inner {
    background: #b3997d;
    padding: 10px 15px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.news-date .day {
    display: block;
    color: #fff;
    font-size: 1.8rem;
    font-weight: bold;
    line-height: 1;
    margin-bottom: 3px;
}

.news-date .month {
    display: block;
    color: #fff;
    font-size: 1rem;
    text-transform: uppercase;
}

.news-content {
    padding: 25px;
    position: relative;
}

.news-content h3 {
    color: #3c2f1b;
    font-size: 1.3rem;
    margin-bottom: 15px;
    line-height: 1.4;
    font-weight: bold;
}

.news-content p {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.read-more {
    color: #b3997d;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    border-bottom: 2px solid transparent;
}

.read-more:hover {
    color: #3c2f1b;
    border-bottom-color: #b3997d;
}

.read-more i {
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(-5px);
}

@media (max-width: 768px) {
    .section-header h2 {
        font-size: 2rem;
    }
    
    .news-image {
        height: 180px;
    }
    
    .news-content h3 {
        font-size: 1.1rem;
    }
    
    .news-content {
        padding: 20px;
    }
}

.view-all {
    color: #b3997d;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
    transition: color 0.3s ease;
}

.view-all:hover {
    color: #3c2f1b;
}

.contact-table {
    border: 1px solid #ddd;
    margin: 20px 0;
}

.contact-table th {
    background-color: #f5f5f5;
    padding: 12px;
    text-align: center;
    border-bottom: 2px solid #ddd;
}

.contact-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.contact-table tr:last-child td {
    border-bottom: none;
}

.contact-table a {
    color: #0066cc;
    text-decoration: none;
}

.contact-table a:hover {
    text-decoration: underline;
}
</style>

<script>
function toggleAnswer(element) {
    // Get the parent question container
    const questionContent = element.closest('.question-content');
    const answerContent = questionContent.querySelector('.answer-content');
    const icon = element.querySelector('i');
    
    if (answerContent.style.display === 'none') {
        // Show answer with animation
        answerContent.style.display = 'block';
        answerContent.style.opacity = '0';
        setTimeout(() => {
            answerContent.style.opacity = '1';
        }, 10);
        icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
        element.classList.add('active');
    } else {
        // Hide answer with animation
        answerContent.style.opacity = '0';
        setTimeout(() => {
            answerContent.style.display = 'none';
        }, 300);
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        element.classList.remove('active');
    }

    // Prevent the default link behavior when toggling
    event.preventDefault();
    
    // Open in new tab after a small delay
    setTimeout(() => {
        window.open(element.getAttribute('href'), '_blank');
    }, 100);
}
</script>
</body>
</html>


