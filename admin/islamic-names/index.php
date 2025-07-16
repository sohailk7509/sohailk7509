<?php

require_once '../includes/session.php';
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <?php include '../includes/sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <?php include '../includes/navbar.php'; ?>

        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-12">
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
                                <button type="submit" name="submit" class="btn btn-primary mt-3">محفوظ کریں</button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4">
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
                                            <a href="edit.php?id=<?php echo $name['id']; ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $name['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
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
    </div>
</div>

<?php include '../includes/footer.php'; ?> 