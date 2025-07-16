<?php
/**
 * Simple Date Function for Pakistan
 * Usage: echo getPakistanDate();
 */

function getPakistanDate() {
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
    $gregorianDay = $currentDate->format('d');
    $gregorianMonth = (int)$currentDate->format('m');
    $gregorianYear = $currentDate->format('Y');
    
    // Current Hijri date (as of April 2025)
    // This needs to be updated manually or use a proper Hijri calendar API
    $currentHijriDay = 17;
    $currentHijriMonth = 12; // Zilhaj
    $currentHijriYear = 1446;
    
    // Format the date
    $hijriDate = $currentHijriDay . $hijriMonths[$currentHijriMonth] . $currentHijriYear . 'ھ';
    $gregorianDate = $gregorianDay . $gregorianMonths[$gregorianMonth] . $gregorianYear . 'ء';
    
    return $hijriDate . '، ' . $gregorianDate;
}

// Alternative function for different format
function getPakistanDateShort() {
    date_default_timezone_set('Asia/Karachi');
    $currentDate = new DateTime();
    
    $hijriMonths = [
        1 => 'محرم', 2 => 'صفر', 3 => 'ربیع الاول', 4 => 'ربیع الثانی',
        5 => 'جمادی الاول', 6 => 'جمادی الثانی', 7 => 'رجب', 8 => 'شعبان',
        9 => 'رمضان', 10 => 'شوال', 11 => 'ذوالقعدہ', 12 => 'ذوالحجہ'
    ];
    
    $gregorianDay = $currentDate->format('d');
    $gregorianMonth = (int)$currentDate->format('m');
    $gregorianYear = $currentDate->format('Y');
    
    // Current Hijri date
    $currentHijriDay = 17;
    $currentHijriMonth = 12; // Zilhaj
    $currentHijriYear = 1446;
    
    return $currentHijriDay . $hijriMonths[$currentHijriMonth] . $currentHijriYear . 'ھ، ' . $gregorianDay . 'اپریل' . $gregorianYear . 'ء';
}

// Function to get current Hijri date (manual update required)
function getCurrentHijriDate() {
    // This should be updated daily or use a proper API
    return [
        'day' => 17,
        'month' => 12,
        'month_name' => 'ذوالحجہ',
        'year' => 1446,
        'full' => '17 ذوالحجہ 1446ھ'
    ];
}
?> 