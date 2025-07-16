<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the requested page from URL, default to 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Include header
include 'header/header.php';

// Load the requested page
switch($page) {
    case 'home':
        include 'pages/home.php';
        break;
        
    case 'taaruf':
        include 'pages/taaruf.php';
        break;
        
    case 'hazrat-banori':
        include 'pages/hazrat-banori.php';
        break;
        
    case 'muqaddama':
        include 'pages/muqaddama.php';
        break;
        
    case 'nazm':
        include 'pages/nazm.php';
        break;
        
    case 'nizam-taleem':
        include 'pages/nizam-taleem.php';
        break;
        
    case 'sharait':
        include 'pages/sharait.php';
        break;
        
    case 'imtehanat':
        include 'pages/imtehanat.php';
        break;
        
    case 'kutub':
        include 'pages/kutub.php';
        break;
        
    case 'branches':
        include 'pages/branches.php';
        break;
        
    case 'donations':
        include 'pages/donations.php';
        break;
        
    case 'contact':
        include 'pages/contact.php';
        break;
        
    case 'new-questions':
        include 'pages/new-questions.php';
        break;
        
    case 'masla-poochain':
        include 'pages/masla-poochain.php';
        break;
        
    case 'khwab-ki-tabeer':
        include 'pages/khwab-ki-tabeer.php';
        break;
        
    case 'islami-naam':
        include 'pages/islami-naam.php';
        break;
        
    case 'namaz-times':
        include 'pages/namaz-times.php';
        break;
        
    case 'banuri-detail':
        include 'pages/banuri-detail.php';
        break;
        
    case 'bayanat':
        include 'pages/bayanat.php';
        break;
        
    case 'books':
        include 'pages/books.php';
        break;
        
    case 'dua':
        include 'pages/dua.php';
        break;
        
    default:
        include 'pages/404.php';
        break;
}

// Include footer
include 'footer/footer.php';
?> 