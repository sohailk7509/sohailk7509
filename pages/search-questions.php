<?php
require_once 'admin/config/db.php';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$results = [];
if ($keyword !== '') {
    $stmt = $db->prepare("SELECT * FROM questions WHERE status = 'published' AND (title LIKE :kw OR content LIKE :kw) ORDER BY created_at DESC");
    $stmt->execute([':kw' => "%$keyword%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ur">
<head>
    <meta charset="UTF-8">
    <title>سوالات کی تلاش</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container" style="margin-top:40px;">
    <h2>سوال تلاش کریں</h2>
    <form method="get" action="">
        <input type="text" name="keyword" class="form-control" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="سوال تلاش کریں..." style="margin-bottom:10px;max-width:350px;">
        <button type="submit" class="btn btn-primary">تلاش کریں</button>
    </form>
    <hr>
    <?php if ($keyword !== ''): ?>
        <h4>"<?php echo htmlspecialchars($keyword); ?>" کے لیے نتائج:</h4>
        <?php if (!empty($results)): ?>
            <ul class="list-group">
                <?php foreach ($results as $q): ?>
                    <li class="list-group-item">
                        <a href="readquestion.php?id=<?php echo $q['id']; ?>">
                            <?php echo htmlspecialchars($q['title']); ?>
                        </a>
                        <span class="badge pull-right"><?php echo date('d-m-Y', strtotime($q['created_at'])); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-warning" style="margin-top:10px;">کوئی سوال نہیں ملا۔</div>
        <?php endif; ?>
    <?php endif; ?>
    <a href="new-questions.php" class="btn btn-link" style="margin-top:20px;">تمام سوالات دیکھیں</a>
</div>
</body>
</html>
