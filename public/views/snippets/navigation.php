<?php
use App\Helpers\Config; // Import the Config class

$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= $basePath ?>/index">UOBS Alumni</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/index">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/jobs">Jobs</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/blogs">Blogs</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/news">News</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/admin/dashboard">Dashboard</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/logout">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/login">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
