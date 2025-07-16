<?php
require_once 'includes/session.php';
require_once 'config/db.php';
checkLogin();

// Get prayer times data
$stmt = $db->query("SELECT * FROM prayer_times ORDER BY id DESC");
$times = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نماز کے اوقات</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="process/add-prayer-times.php">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شہر</label>
                                    <select name="city" class="form-control" required>
                                        <option value="Karachi">کراچی</option>
                                        <option value="Lahore">لاہور</option>
                                        <!-- Add more cities -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>مہینہ</label>
                                    <select name="month" class="form-control" required>
                                        <option value="1">جنوری</option>
                                        <option value="2">فروری</option>
                                        <!-- Add all months -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>فجر</label>
                                    <input type="time" name="fajr" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>طلوع</label>
                                    <input type="time" name="sunrise" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>زوال</label>
                                    <input type="time" name="dhuhr" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>عصر</label>
                                    <input type="time" name="asr" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>غروب</label>
                                    <input type="time" name="maghrib" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>عشاء</label>
                                    <input type="time" name="isha" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-3">محفوظ کریں</button>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>شہر</th>
                                    <th>مہینہ</th>
                                    <th>فجر</th>
                                    <th>طلوع</th>
                                    <th>زوال</th>
                                    <th>عصر</th>
                                    <th>غروب</th>
                                    <th>عشاء</th>
                                    <th>ایکشن</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($times as $time): ?>
                                <tr>
                                    <td><?php echo $time['city']; ?></td>
                                    <td><?php echo $time['month']; ?></td>
                                    <td><?php echo $time['fajr']; ?></td>
                                    <td><?php echo $time['sunrise']; ?></td>
                                    <td><?php echo $time['dhuhr']; ?></td>
                                    <td><?php echo $time['asr']; ?></td>
                                    <td><?php echo $time['maghrib']; ?></td>
                                    <td><?php echo $time['isha']; ?></td>
                                    <td>
                                        <a href="edit-prayer-times.php?id=<?php echo $time['id']; ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete-prayer-times.php?id=<?php echo $time['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
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