<?php
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 sawal-pochain">
                <div class="content-box">
                    <h3 class="text-red">مسئلہ پوچھنے سے متعلق ہدایات</h3>
                    <hr class="big-hr">
                    
                    <div class="notice-box">
                        <p class="text-center">
                            <span class="text-red">
                                <strong>السلام علیکم ورحمۃ اللہ وبرکاتہ</strong>
                            </span>
                        </p>
                        
                        <p class="text-center">
                            <span class="text-red">
                                <strong>
                                    آن لائن سوال جمع کرنے کی سہولت فی الحال عارضی طور پر بند ہے، 
                                    برائے مہربانی بعد میں رابطہ کیجئے۔
                                </strong>
                            </span>
                        </p>
                        
                        <p class="text-center">
                            <span class="text-red">
                                <strong>
                                    عمومی مسائل کی معلومات کے لیے دارالافتاء کا سیکشن ملاحظہ کیجیے۔
                                    نیز "تلاش کریں" کے خانے میں اپنے مسئلہ سے متعلق لفظ لکھ کر بھی 
                                    اپنا مطلوبہ مسئلہ تلاش کر سکتے ہیں۔ جزاکم اللہ
                                </strong>
                            </span>
                        </p>
                        
                        <p class="text-center">
                            <span class="text-red">
                                <strong>
                                    نوٹ: سوال جمع کرنے کے اوقات: صبح 9 بجے تا شام 4 بجے
                                </strong>
                            </span>
                        </p>
                        
                        <p class="text-center">
                            <span class="text-red">
                                <strong>جمعۃ المبارک: تعطیل</strong>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-md-pull-9">
                <div class="side-menu">
                    <h3><i class="icon-talash-icon"></i>تلاش</h3>
                    <div class="form-box">
                        <form id="sidebar-search" method="get" action="search-questions.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="مطلوبہ لفظ" name="title">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="فتوی نمبر" name="fatwa_number">
                            </div>
                            
                            <div class="form-group">
                                <select name="kitab" class="form-control select2">
                                    <option value="">کتاب منتخب کریں</option>
                                    <option value="aqaed">ایمان و عقائد</option>
                                    <option value="uloom-funoon">علوم و فنون</option>
                                    <!-- Add other options here -->
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <select name="bab" class="form-control select2">
                                    <option value="">باب منتخب کریں</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <select name="fasal" class="form-control select2">
                                    <option value="">فصل منتخب کریں</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn-search">
                                <i class="icon-search-icon"></i>
                                <span>تلاش کریں</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.inner-section {
    padding: 40px 0;
    background: #f8f9fa;
}

.content-box {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.05);
}

.text-red {
    color: #e74c3c;
}

.big-hr {
    border: 0;
    height: 2px;
    background: #f0f0f0;
    margin: 20px 0;
}

.notice-box {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    margin-top: 20px;
}

.notice-box p {
    margin-bottom: 20px;
}

.side-menu {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.side-menu h3 {
    color: #3c2f1b;
    font-size: 20px;
    margin: 0 0 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    align-items: center;
}

.side-menu h3 i {
    margin-left: 10px;
    font-size: 24px;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 12px 15px;
    margin-bottom: 15px;
}

.select2-container {
    width: 100% !important;
}

.btn-search {
    width: 100%;
    background: #3c2f1b;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 5px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-search:hover {
    background: #b3997d;
    transform: translateY(-2px);
}

.btn-search i {
    margin-left: 8px;
}

@media (max-width: 768px) {
    .col-md-push-3, .col-md-pull-9 {
        left: auto;
        right: auto;
    }
    
    .side-menu {
        margin-top: 30px;
    }
}
</style>

