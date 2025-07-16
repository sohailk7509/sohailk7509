<?php
function createSlug($string) {
    // Replace non letter or digits by -
    $string = preg_replace('~[^\pL\d]+~u', '-', $string);

    // Transliterate
    $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);

    // Remove unwanted characters
    $string = preg_replace('~[^-\w]+~', '', $string);

    // Trim
    $string = trim($string, '-');

    // Remove duplicate -
    $string = preg_replace('~-+~', '-', $string);

    // Lowercase
    $string = strtolower($string);

    if (empty($string)) {
        return 'n-a';
    }

    return $string;
} 