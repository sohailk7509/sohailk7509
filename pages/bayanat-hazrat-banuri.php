<?php
require_once 'admin/config/db.php';

// Debug query
try {
    $stmt = $db->query("SELECT * FROM bayanat WHERE category = 'hazrat-banuri' ORDER BY id ASC");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debug output
    echo "<!-- Found " . count($articles) . " articles -->";
    echo "<!-- Debug: " . print_r($articles, true) . " -->";
    
} catch(PDOException $e) {
    echo "<!-- Error: " . $e->getMessage() . " -->";
    $articles = [];
}
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="textture-box">
                <div class="col-md-12">
                    <div class="dar-ul-iftah" style="margin-bottom:5px;padding:1px;">
                        <div class="bar">اشاعت خاص حضرت بنوریؒ</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="clearfix"></div>
                    <ul class="star-listing">
                        <li><a href="?page=banuri-detail&id=1">فہرست مضامین اشاعت خاص حضرت بنوریؒ</a></li>
                        <li><a href="?page=banuri-detail&id=2">اسانید الاکابر</a></li>
                        <li><a href="?page=banuri-detail&id=3">خود نوشت سوانح حضرت بنوری رحمہ اللہ  ۔۔۔۔۔۔۔۔ اردو ترجمہ: حضرت مولانا حبیب اللہ مختارؒ</a></li>
                        <!-- Add all other articles -->
                        <?php foreach($articles as $article): ?>
                        <li>
                            <a href="?page=banuri-detail&id=<?php echo $article['id']; ?>">
                                <?php echo $article['title']; ?>
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
.dar-ul-iftah {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.dar-ul-iftah .bar {
    background: #3c2f1b;
    color: #fff;
    padding: 15px 20px;
    font-size: 18px;
    border-radius: 8px 8px 0 0;
}

.star-listing {
    list-style: none;
    padding: 20px;
    margin: 0;
}

.star-listing li {
    margin-bottom: 10px;
    padding-right: 20px;
    position: relative;
}

.star-listing li:before {
    content: "★";
    position: absolute;
    right: 0;
    color: #b3997d;
}

.star-listing li a {
    color: #3c2f1b;
    text-decoration: none;
    transition: color 0.3s;
}

.star-listing li a:hover {
    color: #b3997d;
}
</style> 