<?php
/**
 * Dynamic Date Helper for Pakistan Timezone
 * Provides both Hijri and Gregorian dates
 */

class DateHelper {
    
    /**
     * Convert Gregorian date to Hijri date
     */
    public static function gregorianToHijri($date = null) {
        if ($date === null) {
            $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        } elseif (is_string($date)) {
            $date = new DateTime($date, new DateTimeZone('Asia/Karachi'));
        }
        
        $year = (int)$date->format('Y');
        $month = (int)$date->format('m');
        $day = (int)$date->format('d');
        
        // Hijri months names in Urdu
        $hijriMonths = [
            1 => 'محرم', 2 => 'صفر', 3 => 'ربیع الاول', 4 => 'ربیع الثانی',
            5 => 'جمادی الاول', 6 => 'جمادی الثانی', 7 => 'رجب', 8 => 'شعبان',
            9 => 'رمضان', 10 => 'شوال', 11 => 'ذوالقعدہ', 12 => 'ذوالحجہ'
        ];
        
        // Simple conversion (approximate)
        $hijriYear = $year - 622;
        $hijriMonth = $month;
        $hijriDay = $day;
        
        // Adjust for Hijri calendar differences
        $adjustment = floor(($year - 622) / 33);
        $hijriYear += $adjustment;
        
        return [
            'day' => $hijriDay,
            'month' => $hijriMonth,
            'month_name' => $hijriMonths[$hijriMonth],
            'year' => $hijriYear,
            'full' => $hijriDay . ' ' . $hijriMonths[$hijriMonth] . ' ' . $hijriYear . 'ھ'
        ];
    }
    
    /**
     * Get current Pakistan date in both formats
     */
    public static function getCurrentDate() {
        $pakistanTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        
        $gregorian = [
            'day' => $pakistanTime->format('d'),
            'month' => $pakistanTime->format('m'),
            'year' => $pakistanTime->format('Y'),
            'full' => $pakistanTime->format('d F Y')
        ];
        
        $hijri = self::gregorianToHijri($pakistanTime);
        
        return [
            'gregorian' => $gregorian,
            'hijri' => $hijri,
            'combined' => $hijri['full'] . '، ' . $gregorian['full'] . 'ء'
        ];
    }
    
    /**
     * Get formatted date string
     */
    public static function getFormattedDate() {
        $date = self::getCurrentDate();
        return $date['combined'];
    }
    
    /**
     * Get date for specific day (today, yesterday, tomorrow)
     */
    public static function getRelativeDate($relative = 'today') {
        $pakistanTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        
        switch ($relative) {
            case 'yesterday':
                $pakistanTime->modify('-1 day');
                break;
            case 'tomorrow':
                $pakistanTime->modify('+1 day');
                break;
            case 'today':
            default:
                // Use current date
                break;
        }
        
        $gregorian = [
            'day' => $pakistanTime->format('d'),
            'month' => $pakistanTime->format('m'),
            'year' => $pakistanTime->format('Y'),
            'full' => $pakistanTime->format('d F Y')
        ];
        
        $hijri = self::gregorianToHijri($pakistanTime);
        
        return [
            'gregorian' => $gregorian,
            'hijri' => $hijri,
            'combined' => $hijri['full'] . '، ' . $gregorian['full'] . 'ء'
        ];
    }
}

// Usage examples:
// $currentDate = DateHelper::getFormattedDate();
// $yesterday = DateHelper::getRelativeDate('yesterday');
// $tomorrow = DateHelper::getRelativeDate('tomorrow');
?> 