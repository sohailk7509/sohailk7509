<?php
// Get current month and city
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('n');
$selectedCity = isset($_GET['city']) ? $_GET['city'] : 'Karachi';
$selectedMethod = isset($_GET['method']) ? $_GET['method'] : 1;
$selectedTimeMethod = isset($_GET['time_method']) ? $_GET['time_method'] : 1;

// Get all unique cities
try {
    $citiesStmt = $db->query("SELECT DISTINCT city FROM prayer_times ORDER BY city ASC");
    $cities = $citiesStmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    echo "ڈیٹابیس ایرر: " . $e->getMessage();
}

// Debug information
echo "<!-- Debug: Selected City: $selectedCity, Month: $currentMonth -->";

// Get prayer times data for selected city and month
try {
    $stmt = $db->prepare("SELECT * FROM prayer_times WHERE city = ? AND month = ? ORDER BY date ASC");
    $stmt->execute([$selectedCity, $currentMonth]);
    $times = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debug the results
    echo "<!-- Debug: Found " . count($times) . " records -->";
    
    if (empty($times)) {
        echo "<div class='alert alert-warning'>اس شہر کے لیے کوئی ڈیٹا نہیں ملا</div>";
    }
} catch(PDOException $e) {
    echo "<div class='alert alert-danger'>ڈیٹابیس ایرر: " . $e->getMessage() . "</div>";
}

// Get today's prayer times
try {
    $todayStmt = $db->prepare("SELECT * FROM prayer_times WHERE city = ? AND month = ? AND date = ? LIMIT 1");
    $todayStmt->execute([$selectedCity, date('n'), date('j')]);
    $todayTimes = $todayStmt->fetch(PDO::FETCH_ASSOC);
    
    // Debug today's times
    echo "<!-- Debug: Today's Times: " . print_r($todayTimes, true) . " -->";
} catch(PDOException $e) {
    echo "<!-- Debug: Error getting today's times: " . $e->getMessage() . " -->";
}
?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="sawal-jawab">
                    <h4>نماز کے اوقات | Pakistan | <?php echo $selectedCity; ?> | <?php echo getMonthNameInUrdu($currentMonth); ?></h4>
                </div>
                <img src="assets/images/namaz.jpg" alt="" class="img-responsive">
                <div class="name-results namaz_times">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>تاریخ</th>
                                    <th>فجر</th>
                                    <th>طلوع</th>
                                    <th>زوال</th>
                                    <th>عصر</th>
                                    <th>غروب</th>
                                    <th>عشاء</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($times)): ?>
                                    <?php foreach($times as $time): ?>
                                        <tr <?php echo date('j') == $time['date'] ? 'style="background-color:#e8ddd3"' : ''; ?>>
                                            <td><?php echo sprintf('%02d', $time['date']) . ' ' . getMonthNameInUrdu($currentMonth); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['fajr'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['sunrise'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['dhuhr'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['asr'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['maghrib'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($time['isha'])); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">کوئی ڈیٹا نہیں ملا</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9">
                <div class="side-menu">
                    <h3><i class="icon-talash-icon"></i>تلاش</h3>
                    <div class="form-box">
                        <div class="form-wrapper">
                            <form id="sidebar-sign-in" method="get" action="">
                                <input type="hidden" name="page" value="namaz-times">
                                <div class="form-group">
                                    <select name="city" id="city" class="form-control" data-live-search="true">
                                        <?php foreach(getCities() as $city): ?>
                                        <option value="<?php echo $city; ?>" <?php echo $selectedCity == $city ? 'selected' : ''; ?>><?php echo $city; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="month" id="month" class="form-control" data-live-search="true">
                                        <?php for($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo $currentMonth == $i ? 'selected' : ''; ?>><?php echo getMonthNameInUrdu($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="method" id="method" class="form-control" data-live-search="true">
                                        <option value="1" <?php echo $selectedMethod == 1 ? 'selected' : ''; ?>>جامعہ علوم اسلامیہ بنوری ٹاؤن</option>
                                        <option value="2" <?php echo $selectedMethod == 2 ? 'selected' : ''; ?>>اسلامک یونیورسٹی نارتھ امریکہ</option>
                                        <option value="3" <?php echo $selectedMethod == 3 ? 'selected' : ''; ?>>مسلم ورلڈ لیگ</option>
                                        <option value="4" <?php echo $selectedMethod == 4 ? 'selected' : ''; ?>>ام القرٰی مکہ</option>
                                        <option value="5" <?php echo $selectedMethod == 5 ? 'selected' : ''; ?>>مصری علاقائی ایجنسی</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="time_method" id="time_method" class="form-control" data-live-search="true">
                                        <option value="1" <?php echo $selectedTimeMethod == 1 ? 'selected' : ''; ?>>حنفی</option>
                                        <option value="0" <?php echo $selectedTimeMethod == 0 ? 'selected' : ''; ?>>شافعی، حنبلی</option>
                                    </select>
                                </div>
                                <button type="submit" title="دیکھیں" id="setcountry">
                                    <i class="icon-search-icon"></i>
                                    <span>دیکھیں</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="side-menu">
                    <div class="side-menu">
                        <h3><i class="icon-mazameen-icon"></i>نماز کے اوقات</h3>
                        <p><?php echo date('d-m-Y'); ?> <?php echo $selectedCity; ?> نماز کے اوقات</p>
                        <?php 
                        if($todayTimes):
                        ?>
                        <ul class="timing">
                            <li>
                                <img src="assets/images/morning.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['fajr']; ?></span> فجر
                            </li>
                            <li>
                                <img src="assets/images/morning.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['sunrise']; ?></span> طلوع
                            </li>
                            <li>
                                <img src="assets/images/noon.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['dhuhr']; ?></span> زوال
                            </li>
                            <li>
                                <img src="assets/images/noon.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['asr']; ?></span> عصر
                            </li>
                            <li>
                                <img src="assets/images/evening.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['maghrib']; ?></span> غروب
                            </li>
                            <li>
                                <img src="assets/images/morning.jpg" alt="">
                                <span class="time"><?php echo $todayTimes['isha']; ?></span> عشاء
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
function getMonthNameInUrdu($month) {
    $months = [
        1 => 'جنوری',
        2 => 'فروری',
        3 => 'مارچ',
        4 => 'اپریل',
        5 => 'مئی',
        6 => 'جون',
        7 => 'جولائی',
        8 => 'اگست',
        9 => 'ستمبر',
        10 => 'اکتوبر',
        11 => 'نومبر',
        12 => 'دسمبر'
    ];
    return $months[$month];
}

function getCities() {
    return [
        'Karachi', 'Lahore', 'Islamabad', 'Peshawar', 'Quetta',
        'Multan', 'Faisalabad', 'Rawalpindi', 'Hyderabad', 'Gujranwala'
        // Add more cities as needed
    ];
}

function getPrayerTimes($city, $month) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM prayer_times WHERE city = ? AND month = ? ORDER BY date ASC");
    $stmt->execute([$city, $month]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTodayPrayerTimes($city) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM prayer_times WHERE city = ? AND month = ? AND date = ?");
    $stmt->execute([$city, date('n'), date('j')]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?> 