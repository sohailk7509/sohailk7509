<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <i class="fas fa-mosque me-2"></i>Jamia Banuri
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/index.php" class="list-group-item list-group-item-action bg-transparent second-text <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/questions/index.php" class="list-group-item list-group-item-action bg-transparent second-text <?php echo strpos($_SERVER['PHP_SELF'], 'questions') ? 'active' : ''; ?>">
            <i class="fas fa-question-circle me-2"></i>Questions
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/articles/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-book me-2"></i>Articles
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/speeches/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-microphone me-2"></i>Speeches
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/news/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-rss me-2"></i>News
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/users/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-users me-2"></i>Users
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/settings.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-cog me-2"></i>Settings
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/featured_questions/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-star me-2"></i>Featured Questions
        </a>
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/peace/index.php" class="list-group-item list-group-item-action bg-transparent second-text">
            <i class="fas fa-heart me-2"></i>Peace
        </a>
        <a href="#pageSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-file-alt me-2"></i>صفحات
        </a>
        <div class="collapse" id="pageSubmenu">
            <div class="list-group">
                <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/add-taaruf.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>تعارف
                </a>
                <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/add-hazrat-banori.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>حضرت بنوری رحمہ اللہ
                </a>
                <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/add-nazm.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>جامعہ کا نظم ونسق
                </a>
                <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/add-nizam-taleem.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>نظام تعلیم
                </a>
                <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/add-donations.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-angle-right me-2"></i>طریقہ تعاون
                </a>
            </div>
        </div>

        <!-- Other menu items -->
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/auth/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
            <i class="fas fa-power-off me-2"></i>لاگ آؤٹ
        </a>
    </div>
</div> 