<?php
use App\Helpers\Config; // Import the Config class

$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);
?>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= $basePath ?>/index">UOBS Alumni</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/blogs">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/news">News</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/jobs">Jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/contact">Contact</a></li>
            </ul>
            <form class="d-flex search-bar" role="search">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="/path-to-profile-pic.jpg" alt="Profile" width="30" height="30" class="rounded-circle"> 
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= $basePath ?>/profile">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?= $basePath ?>/logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/admin/dashboard">Dashboard</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
