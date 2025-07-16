<?php
require_once '../includes/session.php';
require_once '../config/db.php';
checkLogin();

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get name details
$stmt = $db->prepare("SELECT * FROM islamic_names WHERE id = ?");
$stmt->execute([$id]);
$name = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$name) {
    header('Location: index.php');
    exit;
}

// Update name
if(isset($_POST['submit'])) {
    $name_text = $_POST['name'];
    $meaning = $_POST['meaning'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $reference = $_POST['reference'];

    try {
        $stmt = $db->prepare("UPDATE islamic_names SET name = ?, meaning = ?, gender = ?, category = ?, reference = ? WHERE id = ?");
        $stmt->execute([$name_text, $meaning, $gender, $category, $reference, $id]);
        $_SESSION['success'] = "نام کامیابی سے اپ ڈیٹ کر دیا گیا";
        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

include '../includes/header.php';
?>

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
                            <h3 class="card-title">نام میں ترمیم کریں</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نام</label>
                                            <input type="text" name="name" class="form-control" value="<?php echo $name['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>معنی</label>
                                            <textarea name="meaning" class="form-control" rows="3" required><?php echo $name['meaning']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>جنس</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="male" <?php echo $name['gender'] == 'male' ? 'selected' : ''; ?>>لڑکا</option>
                                                <option value="female" <?php echo $name['gender'] == 'female' ? 'selected' : ''; ?>>لڑکی</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>کیٹیگری</label>
                                            <select name="category" class="form-control" required>
                                                <option value="Asma-e-Husna-se-Makhoz-Naam" <?php echo $name['category'] == 'Asma-e-Husna-se-Makhoz-Naam' ? 'selected' : ''; ?>>اسماء حسنیٰ سے ماخوذ نام</option>
                                                <option value="Hazrat-Muhammad-SAW-k-Asmaa-Mubarak" <?php echo $name['category'] == 'Hazrat-Muhammad-SAW-k-Asmaa-Mubarak' ? 'selected' : ''; ?>>حضرت محمد ﷺ کے اسماء مبارک</option>
                                                <option value="Ambia-Kiram-AS-k-Naam" <?php echo $name['category'] == 'Ambia-Kiram-AS-k-Naam' ? 'selected' : ''; ?>>انبیاء کرام کے نام</option>
                                                <option value="Sahaba-Kiram-RA-k-Naam" <?php echo $name['category'] == 'Sahaba-Kiram-RA-k-Naam' ? 'selected' : ''; ?>>صحابہ کرام کے نام</option>
                                                <option value="Sahabiyat-RA-k-Naam" <?php echo $name['category'] == 'Sahabiyat-RA-k-Naam' ? 'selected' : ''; ?>>صحابیات کے نام</option>
                                                <option value="Tabieen-or-Taba-Tabieen-k-Naam" <?php echo $name['category'] == 'Tabieen-or-Taba-Tabieen-k-Naam' ? 'selected' : ''; ?>>تابعین کے نام</option>
                                                <option value="Tabieen-or-Taba-Tabieen-Khawateen-k-Naam" <?php echo $name['category'] == 'Tabieen-or-Taba-Tabieen-Khawateen-k-Naam' ? 'selected' : ''; ?>>تابعین خواتین کے نام</option>
                                                <option value="Larkon-k-Mana-k-Aytibar-se-Achay-Naam" <?php echo $name['category'] == 'Larkon-k-Mana-k-Aytibar-se-Achay-Naam' ? 'selected' : ''; ?>>لڑکوں کے اچھے نام</option>
                                                <option value="Larkiyon-k-Mana-k-Aytibar-se-Achay-Naam" <?php echo $name['category'] == 'Larkiyon-k-Mana-k-Aytibar-se-Achay-Naam' ? 'selected' : ''; ?>>لڑکیوں کے اچھے نام</option>
                                                <option value="Buzargan-e-Deen-k-Naam" <?php echo $name['category'] == 'Buzargan-e-Deen-k-Naam' ? 'selected' : ''; ?>>بزرگان دین کے نام</option>
                                                <option value="Nayk-Khawateen-k-Naam" <?php echo $name['category'] == 'Nayk-Khawateen-k-Naam' ? 'selected' : ''; ?>>نیک خواتین کے نام</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>حوالہ</label>
                                            <input type="text" name="reference" class="form-control" value="<?php echo $name['reference']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-3">محفوظ کریں</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 