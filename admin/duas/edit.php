<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $arabic_text = $_POST['arabic_text'];
    $translation = $_POST['translation'];
    $reference = $_POST['reference'];

    try {
        $stmt = $db->prepare("UPDATE duas SET title = ?, category = ?, arabic_text = ?, translation = ?, reference = ? WHERE id = ?");
        $stmt->execute([$title, $category, $arabic_text, $translation, $reference, $id]);
        
        $_SESSION['success'] = "دعا کامیابی سے اپ ڈیٹ کر دی گئی ہے۔";
        header("Location: index.php");
        exit;
    } catch(PDOException $e) {
        $_SESSION['error'] = "دعا اپ ڈیٹ کرنے میں مسئلہ پیش آ گیا ہے۔";
    }
}

// Get dua details
$stmt = $db->prepare("SELECT * FROM duas WHERE id = ?");
$stmt->execute([$id]);
$dua = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dua) {
    header("Location: index.php");
    exit;
}

// Get categories for dropdown
$stmt = $db->query("SELECT * FROM dua_categories ORDER BY name");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">دعا میں ترمیم</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>عنوان</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($dua['title']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>زمرہ</label>
                                    <select name="category" class="form-control" required>
                                        <?php foreach($categories as $cat): ?>
                                            <option value="<?php echo $cat['slug']; ?>" <?php echo ($cat['slug'] == $dua['category']) ? 'selected' : ''; ?>>
                                                <?php echo $cat['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>عربی متن</label>
                                    <textarea name="arabic_text" class="form-control" rows="3" required><?php echo htmlspecialchars($dua['arabic_text']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>ترجمہ</label>
                                    <textarea name="translation" class="form-control" rows="3" required><?php echo htmlspecialchars($dua['translation']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>حوالہ</label>
                                    <input type="text" name="reference" class="form-control" value="<?php echo htmlspecialchars($dua['reference']); ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">محفوظ کریں</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once '../includes/footer.php'; ?> 