<?php
// Include the simple date function
require_once 'includes/simple-date.php';

// Set Pakistan timezone
date_default_timezone_set('Asia/Karachi');
?>

<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Date Example</title>
    <style>
        body {
            font-family: 'Jameel Noori Nastaleeq', Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .date-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .date-display {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .current-time {
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="date-container">
        <h1>پاکستان کی موجودہ تاریخ</h1>
        
        <div class="date-display">
            <?php echo getPakistanDate(); ?>
        </div>
        
        <div class="current-time">
            موجودہ وقت: <?php echo date('H:i:s'); ?>
        </div>
        
        <hr style="margin: 30px 0;">
        
        <h3>استعمال کا طریقہ:</h3>
        <pre style="text-align: left; background: #f8f9fa; padding: 15px; border-radius: 5px;">
&lt;?php
require_once 'includes/simple-date.php';
echo getPakistanDate();
?&gt;
        </pre>
        
        <p style="margin-top: 20px; color: #666;">
            یہ تاریخ ہر روز خود بخود تبدیل ہو جائے گی
        </p>
    </div>
</body>
</html> 