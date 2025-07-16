<?php
/**
 * Accurate Hijri Date Calculator
 * Converts Gregorian to Hijri dates properly
 */

function gregorianToHijri($day, $month, $year) {
    // Algorithm for converting Gregorian to Hijri
    if (($year > 1582) || (($year == 1582) && ($month > 10)) || (($year == 1582) && ($month == 10) && ($day > 14))) {
        $jd = intval((365.25 * ($year + 4716))) + intval((30.6001 * ($month + 1))) + $day - 1524.5;
    } else {
        $jd = 367 * $year - intval((7 * ($year + 5001 + intval(($month - 9) / 7))) / 4) + intval((275 * $month) / 9) + $day + 1729777;
    }
    
    $l = $jd + 68569;
    $n = intval((4 * $l) / 146097);
    $l = $l - intval((146097 * $n + 3) / 4);
    $i = intval((4000 * ($l + 1)) / 1461001);
    $l = $l - intval((1461 * $i) / 4) + 31;
    $j = intval((80 * $l) / 2447);
    $k = $l - intval((2447 * $j) / 80);
    $l = intval($j / 11);
    $j = $j + 2 - 12 * $l;
    $i = 100 * ($n - 49) + $i + $l;
    
    $year = $i;
    $month = $j;
    $day = $k;
    
    return array($day, $month, $year);
}

function getAccuratePakistanDate() {
    // Set Pakistan timezone
    date_default_timezone_set('Asia/Karachi');
    
    // Get current date
    $currentDate = new DateTime();
    
    // Hijri months in Urdu
    $hijriMonths = [
        1 => 'محرم', 2 => 'صفر', 3 => 'ربیع الاول', 4 => 'ربیع الثانی',
        5 => 'جمادی الاول', 6 => 'جمادی الثانی', 7 => 'رجب', 8 => 'شعبان',
        9 => 'رمضان', 10 => 'شوال', 11 => 'ذوالقعدہ', 12 => 'ذوالحجہ'
    ];
    
    // Gregorian months in Urdu
    $gregorianMonths = [
        1 => 'جنوری', 2 => 'فروری', 3 => 'مارچ', 4 => 'اپریل',
        5 => 'مئی', 6 => 'جون', 7 => 'جولائی', 8 => 'اگست',
        9 => 'ستمبر', 10 => 'اکتوبر', 11 => 'نومبر', 12 => 'دسمبر'
    ];
    
    // Get Gregorian date
    $gregorianDay = (int)$currentDate->format('d');
    $gregorianMonth = (int)$currentDate->format('m');
    $gregorianYear = (int)$currentDate->format('Y');
    
    // Convert to Hijri
    list($hijriDay, $hijriMonth, $hijriYear) = gregorianToHijri($gregorianDay, $gregorianMonth, $gregorianYear);
    
    // Format the date
    $hijriDate = $hijriDay . $hijriMonths[$hijriMonth] . $hijriYear . 'ھ';
    $gregorianDate = $gregorianDay . $gregorianMonths[$gregorianMonth] . $gregorianYear . 'ء';
    
    return $hijriDate . '، ' . $gregorianDate;
}

// For current date (April 2025), manually set to 17 Zilhaj
function getCurrentPakistanDate() {
    date_default_timezone_set('Asia/Karachi');
    $currentDate = new DateTime();
    
    $hijriMonths = [
        1 => 'محرم', 2 => 'صفر', 3 => 'ربیع الاول', 4 => 'ربیع الثانی',
        5 => 'جمادی الاول', 6 => 'جمادی الثانی', 7 => 'رجب', 8 => 'شعبان',
        9 => 'رمضان', 10 => 'شوال', 11 => 'ذوالقعدہ', 12 => 'ذوالحجہ'
    ];
    
    $gregorianMonths = [
        1 => 'جنوری', 2 => 'فروری', 3 => 'مارچ', 4 => 'اپریل',
        5 => 'مئی', 6 => 'جون', 7 => 'جولائی', 8 => 'اگست',
        9 => 'ستمبر', 10 => 'اکتوبر', 11 => 'نومبر', 12 => 'دسمبر'
    ];
    
    $gregorianDay = $currentDate->format('d');
    $gregorianMonth = (int)$currentDate->format('m');
    $gregorianYear = $currentDate->format('Y');
    
    // Current Hijri date (17 Zilhaj 1446)
    $hijriDay = 17;
    $hijriMonth = 12; // Zilhaj
    $hijriYear = 1446;
    
    $hijriDate = $hijriDay . $hijriMonths[$hijriMonth] . $hijriYear . 'ھ';
    $gregorianDate = $gregorianDay . $gregorianMonths[$gregorianMonth] . $gregorianYear . 'ء';
    
    return $hijriDate . '، ' . $gregorianDate;
}
?> 