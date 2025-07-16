<section class="inner-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content-box">
                    <?php if(isset($dua) && $dua): ?>
                        <div class="article-header">
                            <h1><?php echo htmlspecialchars($dua['title']); ?></h1>
                            <div class="meta">
                                <span><i class="fas fa-folder"></i> <?php echo htmlspecialchars($dua['category_name']); ?></span>
                                <span><i class="fas fa-calendar"></i> <?php echo date('d-m-Y', strtotime($dua['created_at'])); ?></span>
                            </div>
                        </div>

                        <div class="article-content">
                            <?php if(!empty($dua['arabic_text'])): ?>
                                <div class="arabic-text">
                                    <?php echo $dua['arabic_text']; ?>
                                </div>
                            <?php endif; ?>

                            <div class="translation">
                                <?php echo $dua['translation']; ?>
                            </div>

                            <?php if(!empty($dua['reference'])): ?>
                                <div class="reference">
                                    حوالہ: <?php echo htmlspecialchars($dua['reference']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            دعا کی تفصیلات دستیاب نہیں ہیں۔
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar-box">
                    <h3>تمام دعائیں</h3>
                    <ul class="related-duas">
                        <?php foreach($categories as $category): ?>
                            <li>
                                <a href="?page=dua&category=<?php echo $category['slug']; ?>" 
                                   class="<?php echo (isset($_GET['category']) && $_GET['category'] == $category['slug']) ? 'active' : ''; ?>">
                                    <i class="fas fa-pray"></i>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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

.inner-head {
    margin-bottom: 30px;
}

.inner-head .para p {
    font-size: 24px;
    color: #3c2f1b;
    margin: 0;
}

.list-question {
    list-style: none;
    padding: 0;
}

.list-question li {
    margin-bottom: 15px;
}

.list-question li a {
    display: block;
    padding: 15px;
    background: #fff;
    color: #3c2f1b;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.list-question li a:hover {
    background: #f5f5f5;
    transform: translateY(-2px);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.list-question li i {
    margin-left: 10px;
    color: #b3997d;
}

.side-menu {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
}

.side-menu h3 {
    color: #3c2f1b;
    font-size: 20px;
    margin-bottom: 20px;
}

.side-menu h3 i {
    margin-left: 10px;
    color: #b3997d;
}

.page-links {
    list-style: none;
    padding: 0;
}

.page-links li {
    margin-bottom: 10px;
}

.page-links li a {
    color: #3c2f1b;
    text-decoration: none;
    display: block;
    padding: 8px 10px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.page-links li.active a,
.page-links li a:hover {
    background: #f5f5f5;
    color: #b3997d;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.page-link {
    padding: 8px 12px;
    margin: 0 5px;
    color: #3c2f1b;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.page-item.active .page-link {
    background: #3c2f1b;
    color: #fff;
    border-color: #3c2f1b;
}

.dua-item {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.dua-item a {
    color: inherit;
    text-decoration: none;
}

.dua-item h3 {
    color: #3c2f1b;
    margin-bottom: 15px;
}

.arabic-text {
    font-family: 'Noto Naskh Arabic', serif;
    font-size: 24px;
    line-height: 1.8;
    margin: 15px 0;
    text-align: right;
}

.translation {
    font-size: 16px;
    line-height: 1.6;
    margin: 15px 0;
    color: #666;
}

.reference {
    font-size: 14px;
    color: #b3997d;
    margin-top: 10px;
}

.meta span {
    margin-left: 20px;
    color: #666;
}

.active {
    background: #b3997d !important;
    color: #fff !important;
}

.active i {
    color: #fff !important;
}

.sidebar-box {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    text-align: right;
}

.sidebar-box h3 {
    color: #3c2f1b;
    font-size: 20px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.related-duas {
    list-style: none;
    padding: 0;
    margin: 0;
}

.related-duas li {
    margin-bottom: 10px;
}

.related-duas li a {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    color: #3c2f1b;
    text-decoration: none;
    padding: 12px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
    background: #f8f9fa;
    margin-bottom: 8px;
}

.related-duas li a:hover {
    background: #eee;
    color: #b3997d;
    transform: translateX(5px);
}

.related-duas li a i {
    margin-left: 12px;
    margin-right: 0;
    color: #b3997d;
    font-size: 18px;
    width: 25px;
    text-align: center;
}

.content-box {
    text-align: right;
}

.article-header {
    text-align: right;
}

.meta {
    text-align: right;
}

.meta span {
    margin-right: 20px;
    margin-left: 0;
}

.meta span:first-child {
    margin-right: 0;
}

.meta i {
    margin-left: 5px;
}

@media (max-width: 768px) {
    .sidebar-box {
        margin-top: 20px;
    }
}
</style>

<!-- Add this section for the Quranic Duas download -->
<div class="dropdown-item">
    <a href="uploads/books/qurani-duain.pdf" download="Qurani-Duain.pdf">
        قرآنی دعائیں
    </a>
</div> 