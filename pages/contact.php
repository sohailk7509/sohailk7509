<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <?php if($page): ?>
                    <div class="inner-head">
                        <div class="para">
                            <p><?php echo htmlspecialchars($page['title']); ?></p>
                        </div>
                    </div>
                    <div class="contact-wrapper">
                        <div class="contact-header">
                            <h2>رابطہ کی معلومات</h2>
                            <p>جامعہ علوم اسلامیہ بنوری ٹاؤن کراچی سے رابطہ کے لیے درج ذیل معلومات استعمال کریں</p>
                        </div>
                        
                        <?php 
                        // Parse contact information from page content
                        $content = json_decode($page['content'], true);
                        ?>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="details">
                                    <h3>فون نمبر</h3>
                                    <?php foreach($content['phones'] as $phone): ?>
                                        <p><?php echo htmlspecialchars($phone); ?></p>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="details">
                                    <h3>ای میل</h3>
                                    <?php foreach($content['emails'] as $label => $email): ?>
                                        <a href="mailto:<?php echo $email; ?>"><?php echo htmlspecialchars($email); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="details">
                                    <h3>چھٹی کا دن</h3>
                                    <p><?php echo htmlspecialchars($content['holiday']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <p>رابطہ کی معلومات دستیاب نہیں ہیں۔</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-3 col-md-pull-9">
                <div class="side-menu">
                    <h3><i class="icon-mazameen-icon"></i>معلوماتی لنکس</h3>
                    <ul class="page-links">
                        <li><a href="?page=taaruf">تعارف</a></li>
                        <li><a href="?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a></li>
                        <li><a href="?page=muqaddama">مقدمہ از بانی جامعہ محدث العصر حضرت مولانا سید محمد یوسف بنوری رحمہ اللہ</a></li>
                        <li><a href="?page=jamia-tasis">جامعہ کی تاسیس</a></li>
                        <li><a href="?page=aghraz">جامعہ کے اغراض و مقاصد</a></li>
                        <li><a href="?page=nazm">جامعہ کا نظم ونسق</a></li>
                        <li><a href="?page=nizam-taleem">جامعہ کا نظام تعلیم</a></li>
                        <li><a href="?page=sharait">ضروری ہدایات اور قواعد وضوابط</a></li>
                        <li><a href="?page=imtehanat">امتحانات</a></li>
                        <li><a href="?page=shobay">جامعہ کے شعبہ جات</a></li>
                        <li><a href="?page=kutub">مطبوعہ کتب، رسائل ومقالات</a></li>
                        <li><a href="?page=branches">جامعہ کی شاخیں</a></li>
                        <li><a href="?page=donations">جامعہ کے مصارف</a></li>
                        <li class="<?php echo $_GET['page'] == 'contact' ? 'active' : ''; ?>">
                            <a href="?page=contact">رابطہ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-wrapper {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.contact-header h2 {
    color: #3c2f1b;
    font-size: 28px;
    margin-bottom: 10px;
}

.contact-header p {
    color: #666;
    font-size: 16px;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.contact-item {
    background: #f9f6f0;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.contact-item .icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #b3997d 0%, #9f886f 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.contact-item .icon i {
    color: #fff;
    font-size: 24px;
}

.contact-item .details h3 {
    color: #3c2f1b;
    font-size: 20px;
    margin-bottom: 15px;
}

.contact-item .details p {
    color: #666;
    margin-bottom: 8px;
}

.contact-item .details a {
    color: #b3997d;
    text-decoration: none;
    display: block;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.contact-item .details a:hover {
    color: #3c2f1b;
    transform: translateX(-5px);
}

@media (max-width: 768px) {
    .contact-wrapper {
        padding: 20px;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .contact-item {
        padding: 20px;
    }
}
</style> 