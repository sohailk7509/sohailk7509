<?php
if(!isset($_GET['id'])) {
    header('Location: ?page=islamic-names');
    exit;
}

$id = $_GET['id'];

// Get name details
$stmt = $db->prepare("SELECT * FROM islamic_names WHERE id = ?");
$stmt->execute([$id]);
$name = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$name) {
    header('Location: ?page=islamic-names');
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
        header('Location: ?page=islamic-names');
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">نام میں ترمیم کریں</h1>
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
                                            <!-- Add other categories with selected attribute -->
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
                            <button type="submit" name="submit" class="btn btn-primary">اپ ڈیٹ کریں</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 