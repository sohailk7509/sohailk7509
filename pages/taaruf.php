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
                        <?php echo $page['content']; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>درخواست کردہ صفحہ موجود نہیں ہے۔</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-3 col-md-pull-9">
                    <div class="side-menu">
                        <h3><i class="icon-mazameen-icon"></i>معلوماتی لنکس</h3>
                        <ul class="page-links">
                            <li class="<?php echo $page_id == 'taaruf' ? 'active' : ''; ?>">
                                <a href="?page=taaruf">تعارف</a>
                            </li>
                            <li class="<?php echo $page_id == 'hazrat-banori' ? 'active' : ''; ?>">
                                <a href="?page=hazrat-banori">حضرت بنوری رحمہ اللہ</a>
                            </li>
                            <li class="<?php echo $page_id == 'muqaddama' ? 'active' : ''; ?>">
                                <a href="?page=muqaddama">مقدمہ از بانی جامعہ محدث العصر حضرت مولانا سید محمد یوسف بنوری رحمہ اللہ</a>
                            </li>
                            <li class="<?php echo $page_id == 'jamia-tasis' ? 'active' : ''; ?>">
                                <a href="?page=jamia-tasis">جامعہ کی تاسیس</a>
                            </li>
                            <li class="<?php echo $page_id == 'aghraz' ? 'active' : ''; ?>">
                                <a href="?page=aghraz">جامعہ کے اغراض و مقاصد</a>
                            </li>
                            <li class="<?php echo $page_id == 'nazm' ? 'active' : ''; ?>">
                                <a href="?page=nazm">جامعہ کا نظم ونسق</a>
                            </li>
                            <li class="<?php echo $page_id == 'nizam-taleem' ? 'active' : ''; ?>">
                                <a href="?page=nizam-taleem">جامعہ کا نظام تعلیم</a>
                            </li>
                            <li class="<?php echo $page_id == 'sharait' ? 'active' : ''; ?>">
                                <a href="?page=sharait">ضروری ہدایات اور قواعد وضوابط</a>
                            </li>
                            <li class="<?php echo $page_id == 'imtehanat' ? 'active' : ''; ?>">
                                <a href="?page=imtehanat">امتحانات</a>
                            </li>
                            <li class="<?php echo $page_id == 'shobay' ? 'active' : ''; ?>">
                                <a href="?page=shobay">جامعہ کے شعبہ جات</a>
                            </li>
                            <li class="<?php echo $page_id == 'kutub' ? 'active' : ''; ?>">
                                <a href="?page=kutub">مطبوعہ کتب، رسائل ومقالات</a>
                            </li>
                            <li class="<?php echo $page_id == 'branches' ? 'active' : ''; ?>">
                                <a href="?page=branches">جامعہ کی شاخیں</a>
                            </li>
                            <li class="<?php echo $page_id == 'donations' ? 'active' : ''; ?>">
                                <a href="?page=donations">جامعہ کے مصارف</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>