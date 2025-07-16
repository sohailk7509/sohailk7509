<?php
require_once 'admin/config/db.php';

// Get names from database based on filters
$word = isset($_GET['word']) ? $_GET['word'] : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';

$sql = "SELECT * FROM islamic_names WHERE 1=1";
if($word) {
    $sql .= " AND name LIKE :word";
}
if($gender) {
    $sql .= " AND gender = :gender";
}

$stmt = $db->prepare($sql);
if($word) {
    $stmt->bindValue(':word', $word.'%');
}
if($gender) {
    $stmt->bindValue(':gender', $gender);
}
$stmt->execute();
$names = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="name-search">
                    <form action="" method="GET">
                        <input type="hidden" name="page" value="islami-naam">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <select name="word" class="form-control select2">
                                        <option value="">حرف منتخب کریں</option>
                                        <option value="1-الف">الف</option>
                                        <option value="2-ب">ب</option>
                                        <option value="3-ت">ت</option>
                                        <option value="4-ث">ث</option>
                                        <option value="5-ج">ج</option>
                                        <option value="6-ح">ح</option>
                                        <option value="7-خ">خ</option>
                                        <option value="8-د">د</option>
                                        <option value="9-ذ">ذ</option>
                                        <option value="10-ر">ر</option>
                                        <option value="11-ز">ز</option>
                                        <option value="12-س">س</option>
                                        <option value="13-ش">ش</option>
                                        <option value="14-ص">ص</option>
                                        <option value="15-ض">ض</option>
                                        <option value="16-ط">ط</option>
                                        <option value="17-ظ">ظ</option>
                                        <option value="18-ع">ع</option>
                                        <option value="19-غ">غ</option>
                                        <option value="20-ف">ف</option>
                                        <option value="21-ق">ق</option>
                                        <option value="22-ک">ک</option>
                                        <option value="23-ل">ل</option>
                                        <option value="24-م">م</option>
                                        <option value="25-ن">ن</option>
                                        <option value="26-و">و</option>
                                        <option value="27-ہ">ہ</option>
                                        <option value="28-ی">ی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <select name="gender" class="form-control select2">
                                        <option value="">جنس منتخب کریں</option>
                                        <option value="male">لڑکا</option>
                                        <option value="female">لڑکی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> تلاش کریں
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="name-results">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>نام</th>
                                <th>معنی</th>
                                <th>نام</th>
                                <th>معنی</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($names as $name): 
                                if($i % 2 == 0) echo '<tr>';
                            ?>
                                <td>
                                    <a href="?page=name-detail&id=<?php echo $name['id']; ?>">
                                        <?php echo $name['name']; ?>
                                    </a>
                                </td>
                                <td><?php echo $name['meaning']; ?></td>
                            <?php 
                                if($i % 2 == 1) echo '</tr>';
                                $i++;
                            endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3 col-md-pull-9">
                <div class="side-menu">
                    <h3><i class="icon-mazameen-icon"></i>معلوماتی لنکس</h3>
                    <ul class="page-links">
                        <li><a href="?page=islami-naam&cat=Asma-e-Husna-se-Makhoz-Naam">اسماء حسنیٰ سے ماخوذ نام</a></li>
                        <li><a href="?page=islami-naam&cat=Hazrat-Muhammad-SAW-k-Asmaa-Mubarak">امام الانبیاء حضرت محمد ﷺ کے اسماء مبارک</a></li>
                        <li><a href="?page=islami-naam&cat=Ambia-Kiram-AS-k-Naam">انبیاء کرام علیہم السلام کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Sahaba-Kiram-RA-k-Naam">صحابہ کرام رضی اللہ عنہم کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Sahabiyat-RA-k-Naam">صحابیات رضی اللہ عنہن کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Tabieen-or-Taba-Tabieen-k-Naam">تابعین اور تبع تابعین کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Tabieen-or-Taba-Tabieen-Khawateen-k-Naam">تابعین اور تبع تابعین خواتین کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Larkon-k-Mana-k-Aytibar-se-Achay-Naam">لڑکوں کے معنی کے اعتبار سے اچھے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Larkiyon-k-Mana-k-Aytibar-se-Achay-Naam">لڑکیوں کے معنی کے اعتبار سے اچھے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Buzargan-e-Deen-k-Naam">بزرگان دین کے نام</a></li>
                        <li><a href="?page=islami-naam&cat=Nayk-Khawateen-k-Naam">نیک خواتین کے نام</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.name-search {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.name-results {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.table th {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    text-align: center;
}

.table td {
    padding: 12px;
    border-bottom: 1px solid #dee2e6;
}

.table td a {
    color: #3c2f1b;
    text-decoration: none;
    transition: color 0.3s;
}

.table td a:hover {
    color: #b3997d;
}

.side-menu {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.page-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-links li a {
    display: block;
    padding: 10px;
    color: #3c2f1b;
    text-decoration: none;
    transition: all 0.3s;
}

.page-links li a:hover {
    background: #f8f9fa;
    color: #b3997d;
}
</style> 