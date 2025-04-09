<?php
use App\Helpers\Config;

$basePath = rtrim(Config::get('BASE_PATH', '/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);

function isAuthenticated() {
    return isset($_SESSION['username']);
}

function hasPermission($permission) {
    if ($_SESSION['is_super_user']) {
        return true;
    }
    if (!isset($_SESSION['permissions']) || empty($_SESSION['permissions'])) {
        return false;
    }
    return in_array($permission, array_column($_SESSION['permissions'], 'slug'));
}
?>
<script>
    var basePath = "<?= $basePath ?>";
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel'; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/css/styles.css">

    <!-- Custom Dropdown Styles -->
    <style>
        .dropdown-menu-custom {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 200px;
            top: 100%;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 0.25rem;
            padding: 0.5rem 0;
        }

        .dropdown-menu-custom li {
            list-style: none;
        }

        .dropdown-menu-custom .dropdown-item {
            padding: 0.5rem 1rem;
            display: block;
            color: #212529;
            text-decoration: none;
        }

        .dropdown-menu-custom .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-toggle-custom {
            cursor: pointer;
            border: none;
            background: none;
            color: #fff;
            padding: 0.5rem 1rem;
        }

        .nav-item.position-relative {
            position: relative;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container" style="overflow: visible;">
            <a class="navbar-brand" href="<?= $basePath ?>/admin/index">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isAuthenticated()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>/admin/index">Dashboard</a>
                        </li>

                        <?php if (hasPermission('view_admin_jobs')): ?>
                            <li class="nav-item position-relative">
                                <button class="dropdown-toggle-custom" id="jobDropdownCustom">Jobs</button>
                                <ul class="dropdown-menu-custom" id="jobDropdownMenuCustom">
                                    <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs">Jobs</a></li>

                                    <?php if (hasPermission('view_job_categories')): ?>
                                        <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/categories">Job Categories</a></li>
                                    <?php endif; ?>

                                    <?php if (hasPermission('view_job_fields')): ?>
                                        <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/fields">Job Fields</a></li>
                                    <?php endif; ?>

                                    <?php if (hasPermission('view_job_education')): ?>
                                        <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/education">Job Education Level</a></li>
                                    <?php endif; ?>

                                    <?php if (hasPermission('view_job_types')): ?>
                                        <li><a class="dropdown-item" href="<?= $basePath ?>/admin/jobs/types">Job Types</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (hasPermission('view_admin_news')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $basePath ?>/admin/news">News</a>
                            </li>
                        <?php endif; ?>

<?php if (hasPermission('view_admin_blogs')): ?>
    <li class="nav-item position-relative">
        <button class="dropdown-toggle-custom" id="blogDropdownCustom">Blogs</button>
        <ul class="dropdown-menu-custom" id="blogDropdownMenuCustom">
            <?php if (hasPermission('view_blog_categories')): ?>
                <li><a class="dropdown-item" href="<?= $basePath ?>/admin/blog/categories">Blog Categories</a></li>
            <?php endif; ?>
            <li><a class="dropdown-item" href="<?= $basePath ?>/admin/blogs">Blogs</a></li>
        </ul>
    </li>
<?php endif; ?>

<?php if (hasPermission('view_users')): ?>
    <li class="nav-item position-relative">
        <button class="dropdown-toggle-custom" id="userDropdownCustom">User Management</button>
        <ul class="dropdown-menu-custom" id="userDropdownMenuCustom">
            <li><a class="dropdown-item" href="<?= $basePath ?>/admin/users">Users</a></li>
        </ul>
    </li>
<?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= $basePath ?>/index">View Website</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= $basePath ?>/logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?= $basePath ?>/login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Page Container -->
<div class="container mt-4">
