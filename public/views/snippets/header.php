<?php
// session_start();
if (!isset($title)) {
    $title = "UOBS Alumni";
}

use App\Helpers\Config;
$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - UOBS Alumni</title>
    <!-- <link rel="stylesheet" href="/UOBSAlumani/php-crud-app/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="/UOBSAlumani/public/css/style.css"> -->
    
    
    <!-- Vendor CSS Files -->
    <link href="/UOBSAlumani/public/assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/UOBSAlumani/public/assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/UOBSAlumani/public/assets/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/UOBSAlumani/public/assets/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/UOBSAlumani/public/assets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/UOBSAlumani/public/assets/assets/css/main.css" rel="stylesheet">
    <style>
        .navbar {
            background: #343a40;
            padding: 10px 20px;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: #fff !important;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #f8f9fa !important;
            transform: scale(1.05);
        }
        .search-bar {
            max-width: 300px;
        }
    </style>
</head>
<body class="index-page">
<?php include 'navigation.php'; ?>
<main class="main">