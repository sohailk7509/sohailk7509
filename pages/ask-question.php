<?php
require_once '../admin/config/db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($name && $title && $content) {
        $stmt = $db->prepare("INSERT INTO questions (name, email, title, content, status, created_at) VALUES (?, ?, ?, ?, 'pending', NOW())");
        if ($stmt->execute([$name, $email, $title, $content])) {
            $message = 'آپ کا سوال کامیابی سے جمع ہو گیا ہے۔ جواب جلد فراہم کر دیا جائے گا۔';
        } else {
            $message = 'سوال جمع کرنے میں مسئلہ پیش آیا۔ دوبارہ کوشش کریں۔';
        }
    } else {
        $message = 'براہ کرم تمام ضروری معلومات فراہم کریں۔';
    }
}
?>
<!DOCTYPE html>
<html lang="ur">
<head>
    <meta charset="UTF-8">
    <title>نیا سوال پوچھیں</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container" style="margin-top:40px;max-width:600px;">
    <h2>نیا سوال پوچھیں</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label>نام*</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>ای میل (اختیاری)</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>سوال کا عنوان*</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>سوال کی تفصیل*</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">جمع کروائیں</button>
        <a href="new-questions.php" class="btn btn-link">واپس جائیں</a>
    </form>
</div>
</body>
</html>
