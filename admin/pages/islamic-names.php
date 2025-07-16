<?php
// Check if form is submitted
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $meaning = $_POST['meaning'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $reference = $_POST['reference'];

    try {
        $stmt = $db->prepare("INSERT INTO islamic_names (name, meaning, gender, category, reference) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $meaning, $gender, $category, $reference]);
        $_SESSION['success'] = "نام کامیابی سے شامل کر دیا گیا";
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

// Get all names
$stmt = $db->query("SELECT * FROM islamic_names ORDER BY id DESC");
$names = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">اسلامی نام</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">نیا نام شامل کریں</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نام</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>معنی</label>
                                        <textarea name="meaning" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>جنس</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="male">لڑکا</option>
                                            <option value="female">لڑکی</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>کیٹیگری</label>
                                        <select name="category" class="form-control" required>
                                            <option value="Asma-e-Husna-se-Makhoz-Naam">اسماء حسنیٰ سے ماخوذ نام</option>
                                            <option value="Hazrat-Muhammad-SAW-k-Asmaa-Mubarak">حضرت محمد ﷺ کے اسماء مبارک</option>
                                            <option value="Ambia-Kiram-AS-k-Naam">انبیاء کرام کے نام</option>
                                            <option value="Sahaba-Kiram-RA-k-Naam">صحابہ کرام کے نام</option>
                                            <option value="Sahabiyat-RA-k-Naam">صحابیات کے نام</option>
                                            <option value="Tabieen-or-Taba-Tabieen-k-Naam">تابعین کے نام</option>
                                            <option value="Tabieen-or-Taba-Tabieen-Khawateen-k-Naam">تابعین خواتین کے نام</option>
                                            <option value="Larkon-k-Mana-k-Aytibar-se-Achay-Naam">لڑکوں کے اچھے نام</option>
                                            <option value="Larkiyon-k-Mana-k-Aytibar-se-Achay-Naam">لڑکیوں کے اچھے نام</option>
                                            <option value="Buzargan-e-Deen-k-Naam">بزرگان دین کے نام</option>
                                            <option value="Nayk-Khawateen-k-Naam">نیک خواتین کے نام</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>حوالہ</label>
                                        <input type="text" name="reference" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">محفوظ کریں</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">تمام نام</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>معنی</th>
                                    <th>جنس</th>
                                    <th>کیٹیگری</th>
                                    <th>حوالہ</th>
                                    <th>ایکشن</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($names as $name): ?>
                                <tr>
                                    <td><?php echo $name['name']; ?></td>
                                    <td><?php echo $name['meaning']; ?></td>
                                    <td><?php echo $name['gender'] == 'male' ? 'لڑکا' : 'لڑکی'; ?></td>
                                    <td><?php echo $name['category']; ?></td>
                                    <td><?php echo $name['reference']; ?></td>
                                    <td>
                                        <a href="?page=edit-name&id=<?php echo $name['id']; ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="?page=delete-name&id=<?php echo $name['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 