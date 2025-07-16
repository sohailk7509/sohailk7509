<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $db->prepare("DELETE FROM islamic_names WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "نام کامیابی سے حذف کر دیا گیا";
    } catch(PDOException $e) {
        $_SESSION['error'] = "خرابی: " . $e->getMessage();
    }
}

header('Location: ?page=islamic-names');
exit; 