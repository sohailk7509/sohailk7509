<?php 
$base_url = "/sohail-project2/admin";
?>

<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <i class="fas fa-mosque me-2"></i>Jamia Banuri
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="<?php echo $base_url; ?>/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>

      <a href="#books" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>صفحہ اول
        </a>
        <div class="collapse" id="books">
            <div class="list-group">
                 <a href="<?php echo $base_url; ?>/speeches/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-microphone me-2"></i>Speeches
                </a>
                  <a href="<?php echo $base_url; ?>/featured_questions/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-star me-2"></i>Featured Questions
        </a>
         <a href="<?php echo $base_url; ?>/news/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-rss me-2"></i>News
        </a>
        <a href="<?php echo $base_url; ?>/peace/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-heart me-2"></i>Peace
        </a>
            </div>
        </div>

        <a href="#pageSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>سرورق
        </a>
        <div class="collapse" id="pageSubmenu">
            <div class="list-group">
                <a href="<?php echo $base_url; ?>/pages/add-taaruf.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>تعارف
                </a>
                <a href="<?php echo $base_url; ?>/pages/add-hazrat-banori.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>حضرت بنوری رحمہ اللہ
                </a>
                <a href="<?php echo $base_url; ?>/pages/add-nazm.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>جامعہ کا نظم ونسق
                </a>
                <a href="<?php echo $base_url; ?>/pages/add-nizam-taleem.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>نظام تعلیم
                </a>
                <a href="<?php echo $base_url; ?>/pages/add-donations.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>طریقہ تعاون
                </a>
               
               
            </div>
            
        </div>
        <a href="#pageifta" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>دارالافتاء
        </a>
        <div class="collapse" id="pageifta">
            <div class="list-group">
                  <a href="<?php echo $base_url; ?>/featured_questions/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
                 <i class="fas fa-question-circle me-2"></i>Questions
                </a>
                <!-- <a href="<?php echo $base_url; ?>/articles/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-book me-2"></i>Articles
                </a> -->
                <a href="<?php echo $base_url; ?>/islamic-names/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-book me-2"></i>Islamic Names
        </a>
                <a href="<?php echo $base_url; ?>/namaz-times/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-clock me-2"></i>Namaz Times
        </a>
            </div>
        </div>
        
       <a href="#books1" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>کتابیں
        </a>
        <div class="collapse" id="books1">
            <div class="list-group">
                 <a href="<?php echo $base_url; ?>/books/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-book me-2"></i>Books
        </a>
            </div>
        </div>

        <a href="#dua" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>دعائیں
        </a>
        <div class="collapse" id="dua">
            <div class="list-group">
                  <a href="<?php echo $base_url; ?>/duas/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-book-open me-2"></i>Duas
        </a>
            </div>
        </div>
        <a href="<?php echo $base_url; ?>/users/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-users me-2"></i>Users
        </a>
        <a href="<?php echo $base_url; ?>/settings.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-cog me-2"></i>Settings
        </a>
       
        
       
        
        
       
        
        <a href="<?php echo $base_url; ?>/auth/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
            <i class="fas fa-power-off me-2"></i>LogOut
        </a>
    </div>
</div> 