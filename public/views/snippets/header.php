<?php
session_start();
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
    <link rel="stylesheet" href="/UOBSAlumani/php-crud-app/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/UOBSAlumani/php-crud-app/public/css/style.css">
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
<body>

<?php include 'navigation.php'; ?>
