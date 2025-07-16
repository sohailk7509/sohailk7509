<?php


require_once '../config/db.php';

// Get all duas
$stmt = $db->query("SELECT * FROM duas ORDER BY id DESC");
$duas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin-style.css" rel="stylesheet">
</head>
<style>
.text-end {
    text-align: right !important;
}

</style>
<body>

<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">دعائیں</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="add.php" class="btn btn-primary ">نئی دعا شامل کریں</a>
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
                            <table id="duasTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>قسم</th>
                                        <th>عربی متن</th>
                                        <th>ترجمہ</th>
                                        <th>حوالہ</th>
                                        <th>ایکشن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($duas as $dua): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($dua['title']); ?></td>
                                        <td><?php echo htmlspecialchars($dua['category']); ?></td>
                                        <td class="ar_writing"><?php echo $dua['arabic_text']; ?></td>
                                        <td><?php echo htmlspecialchars($dua['translation']); ?></td>
                                        <td><?php echo htmlspecialchars($dua['reference']); ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $dua['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $dua['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('کیا آپ واقعی اس دعا کو حذف کرنا چاہتے ہیں؟');">
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
</div>
                                    </div>
                                    </div>
                                    
<script>
$(document).ready(function() {
    $('#duasTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Urdu.json"
        }
    });
});
</script>
