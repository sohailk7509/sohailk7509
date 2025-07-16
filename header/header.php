
                        
<?php
require_once 'includes/hijri-date.php';
// Include dynamic date function
require_once 'includes/simple-date.php';
?>
<header>
    <!-- Top Header -->
    <div class="top-header-bar">
        <div class="container">
            <div class="row align-items-center">
                <!-- Date Display - Visible on all screens -->
                <div class="col-lg-4 col-md-4 col-12 text-start">
                    <div class="date-display text-white">
                        <?php echo getPakistanDate(); ?>
                    </div>
                </div>
                <!-- Bismillah - Center on all screens -->
                <div class="col-lg-4 col-md-4 col-12 text-center">
                    <div class="bismillah">
                        بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ
                    </div>
                </div>
   
                <!-- Language Selector with Google Translate -->
                <div class="col-lg-4 col-md-4 col-12 text-end">
                    <div class="language-selector">
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-sm btn-primary login-text">لاگ ان</button>
                            
                            <!-- Add Google Translate Element -->
                            <div id="google_translate_element" class="me-2"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'ur',
                includedLanguages: 'en,ar,ur', 
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Main Header -->
    <nav class="top-navbar navbar navbar-expand-lg main-header">
        <div class="container">
            <a class="navbar-brand" href="main.php">
                <img src="assets/images/logo1.png" alt="جامع مسجد یحیی علامہ محمد وسیم فیضی ملتان" class="img-fluid logo-img">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 main-menu">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            سرورق
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?page=taaruf">تعارف</a>
                            <a class="dropdown-item" href="?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a>
                            <!-- <a class="dropdown-item" href="?page=muqaddama">مقدمہ از بانی جامعہ محدث العصر حضرت مولانا سید محمد یوسف بنوری رحمہ اللہ</a> -->
                            <!-- <a class="dropdown-item" href="?page=jamia-tasis">جامعہ کی تاسیس</a> -->
                         
                            <a class="dropdown-item" href="?page=nazm">جامعہ کا نظم ونسق</a>
                            <a class="dropdown-item" href="?page=nizam-taleem">جامعہ کا نظام تعلیم</a>
                            <!-- <a class="dropdown-item" href="?page=sharait">ضروری ہدایات اور قواعد وضوابط</a> -->
                            <!-- <a class="dropdown-item" href="?page=imtehanat">امتحانات</a> -->
                            <!-- <a class="dropdown-item" href="?page=shobay">جامعہ کے شعبہ جات</a> -->
                            <!-- <a class="dropdown-item" href="?page=kutub">مطبوعہ کتب، رسائل ومقالات</a> -->
                            <!-- <a class="dropdown-item" href="?page=branches">جامعہ کی شاخیں</a> -->
                            <a class="dropdown-item" href="?page=donations">جامعہ کے مصارف</a>
                            <a class="dropdown-item" href="?page=contact">رابطہ</a>
                            <a class="dropdown-item" href="?page=donations">طریقہ تعاون</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="daruliftaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            دارالافتاء
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?page=new-questions">نئے سوالات</a>
                            <a class="dropdown-item" href="?page=masla-poochain">مسئلہ پوچھیں</a>
                            <a class="dropdown-item" href="?page=khwab-ki-tabeer">خواب کی تعبیر معلوم کریں</a>
                            <a class="dropdown-item" href="?page=islami-naam">اسلامی نام</a>
                            <a class="dropdown-item" href="?page=namaz-times">نماز کے اوقات</a>
                            <a class="dropdown-item" href="?page=jamia-rules">جامعہ کے قوانین اور دوسرے قوم کو دی گئی مراعات نہیں</a>
                            <a class="dropdown-item" href="?page=jamia-certificate">جامعہ کے پاس سند کے بغیر پڑھانے والے</a>
                            <a class="dropdown-item" href="?page=jamia-fees">جامعہ سے درسی وجہ حاصل کرنے کا طریقہ</a>
                            <a class="dropdown-item" href="?page=waqt-namaz">وقتی نماز اور وظائف کا اظہار کرنے کی گزارش</a>
                            <a class="dropdown-item" href="?page=shab-barat">شب برات 1446ھ</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="biyanat.php" id="bayanatDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="window.location='?page=taaruf'">
                                بینات
                            </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?page=banuri-detail&id=hazrat-banuri">حضرت بنوری رحمۃ اللہ علیہ</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=ramadan">ماہِ رمضان اور اُس کی برکات و فضائل</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=internet">انٹرنیٹ کے منفی استعمال کے نقصانات</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=smartphone">اسمارٹ فون ... اخلاقِ رذیلہ کا سرچشمہ</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=sunnat">برکاتِ سُنَّت</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=madaris">دینی مدارس کا نصاب ونظام</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=ulama">علماء کرام کی ذمہ داریاں</a>
                            <a class="dropdown-item" href="?page=banuri-detail&id=islam">دین ِاسلام سے مسلمانوں کی روگردانی</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="booksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            کتابیں
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="booksDropdown">
                            <li>
                                <a class="dropdown-item" href="?page=books">
                                    مطبوعہ کتب، رسائل ومقالات
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://www.banuri.edu.pk/assets/uploads/2020/04/1587989145_book_pdf.pdf">
                                    تعارف جامعۃ العلوم الاسلامیہ علامہ محمد یوسف بنوری ٹاؤن
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="booksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            دعائیں
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="booksDropdown">
                            <a class="dropdown-item" href="?page=dua&id=dua-mangny-ka-tariqa">دعا مانگنے کا طریقہ اور وتر کی دعا</a>
                            <a class="dropdown-item" href="?page=dua&category=islami-azkar">اسلامی اذکار ودعائیں! احکام وفضائل</a>
                            <a class="dropdown-item" href="?page=dua&id=iftari-dua">افطاری کے وقت دعا کرنا</a>
                            <a class="dropdown-item" href="https://www.banuri.edu.pk/assets/uploads/2021/02/1613978405_book_pdf.pdf">قرآنی دعائیں</a>
                            <a class="dropdown-item" href="https://www.banuri.edu.pk/assets/uploads/2021/02/1613979130_book_pdf.pdf">استخارہ سنت کے مطابق کیجیے</a>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="booksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            آن لائن دفتر
                        </a>
                    </li>
                   
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="questions.php">سوالات و جوابات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles.php">مضامین</a>
                    </li> -->
                </ul>
                <form class="d-flex search-form">
                    <div class="search-wrapper">
                        <input type="search" class="search-input" placeholder="تلاش کریں">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>

<!-- <div class="header-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="menu">
                    <li><a href="index.php">ہوم</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">جامعہ کا تعارف</a>
                        <ul class="dropdown-menu">
                            <li><a href="page.php?page=taaruf">تعارف</a></li>
                            <li><a href="page.php?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a></li>
                            <li><a href="page.php?page=muqaddama">مقدمہ از بانی جامعہ</a></li>
                            <li><a href="page.php?page=jamia-tasis">جامعہ کی تاسیس</a></li>
                            <li><a href="page.php?page=aghraz">جامعہ کے اغراض و مقاصد</a></li>
                            <li><a href="page.php?page=nazm">جامعہ کا نظم ونسق</a></li>
                            <li><a href="page.php?page=nizam-taleem">جامعہ کا نظام تعلیم</a></li>
                        </ul>
                    </li>
                    <li><a href="questions.php">سوالات و جوابات</a></li>
                    <li><a href="articles.php">مضامین</a></li>
                    <li><a href="speeches.php">خطابات</a></li>
                    <li><a href="news.php">خبریں</a></li>
                    <li><a href="quran.php">قرآن</a></li>
                    <li><a href="azkar.php">اذکار</a></li>
                    <li><a href="tazkiya.php">تزکیہ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

<style>
.header-menu {
    background: #3c2f1b;
}

.menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.menu > li {
    position: relative;
}

.menu > li > a {
    color: #fff;
    padding: 15px 20px;
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
}

.menu > li:hover > a {
    background: #b3997d;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: #fff;
    min-width: 200px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 4px;
    z-index: 1000;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu li a {
    color: #3c2f1b;
    padding: 10px 20px;
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
}

.dropdown-menu li a:hover {
    background: #f5f5f5;
    color: #b3997d;
}

@media (max-width: 768px) {
    .menu {
        flex-direction: column;
    }
    
    .dropdown-menu {
        position: static;
        box-shadow: none;
        display: none;
    }
    
    .dropdown:hover .dropdown-menu {
        display: none;
    }
    
    .dropdown.show .dropdown-menu {
        display: block;
    }
}
</style>

<script>
$(document).ready(function() {
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('show');
    });
});
</script>