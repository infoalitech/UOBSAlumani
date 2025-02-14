<?php
use App\Helpers\Config; // Import the Config class

$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);
?>
<script>
    var basePath = "<?= $basePath ?>"; // Pass PHP variable to JS
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin Panel'; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/UOBSAlumani/php-crud-app/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= $basePath ?>/admin/index">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>/admin/index">Dashboard</a>
                        </li>


                        <!-- Job Management Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="jobDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Jobs
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="jobDropdown">
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs">Jobs</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/categories">Job Categories</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/fields">Job Fields</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/education">Job Education Level</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/types">Job Types</a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= $basePath ?>/admin/news">News</a>
                        </li>

                        <!-- Blog Management Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blogs
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="blogDropdown">
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/blog/categories">Blog Categories</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/blogs">Blogs</a></li>
                            </ul>
                        </li>


                        <!-- User Management Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/users">Users</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/permissions">Permissions</a></li>
                                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/user/permissions">User Permissions</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= $basePath ?>/index">View Website</a>
                        </li>
                        <!-- Logout Button -->
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= $basePath ?>/logout">Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Container -->
    <div class="container mt-4">
