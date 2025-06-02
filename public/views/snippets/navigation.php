<?php
use App\Helpers\Config; // Import the Config class

$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="<?= $basePath ?>/index" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="https://uobs.edu.pk/images/logo/logo.png" alt="">
            <h1 class="sitename">UOBS Alumni</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="<?= $basePath ?>/home" class="active">Home</a></li>
                <li><a href="<?= $basePath ?>/convocations">Convocations</a></li>
                <li><a href="<?= $basePath ?>/blogs">Blogs</a></li>
                <li><a href="<?= $basePath ?>/news">News</a></li>
                <li><a href="<?= $basePath ?>/jobs">Jobs</a></li>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </ul>
        </nav>
        <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && ($_SESSION['user']['is_alumni'] ?? 0) == 1): ?>
            <nav id="navmenu" class="navmenu">
            <ul>
            <li class="dropdown d-none d-xl-block">
                <a href="#" class=" px-3 btn-getstarted"><span><?= htmlspecialchars($_SESSION['name'] ?? 'My Account') ?></span> <i class="btn-getstartedbi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <?php if (($_SESSION['user']['status'] ?? '') === 'active'): ?>
                        <li><a href="<?= $basePath ?>/alumni/job/index">View My Jobs</a></li>
                        <li><a href="<?= $basePath ?>/alumni/job/create">Post a Job</a></li>
                        <li><a href="<?= $basePath ?>/change-password">Change Password</a></li>
                    <?php else: 
                                $status = $_SESSION['user']['status'] ?? 'unknown';
                                $statusClass = [
                                    'active' => 'success',
                                    'inactive' => 'danger',
                                    'pending' => 'warning'
                                ];
                                $badgeClass = $statusClass[$status] ?? 'secondary';
                                ?>
                                <li>
                                    <a href="<?= $basePath ?>/profile/view">
                                        <span class="badge bg-<?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                                    </a>
                                </li>
                    <?php  endif;  ?>
                        <li><a href="<?= $basePath ?>/profile/view">View Profile</a></li>
                        <li><a href="<?= $basePath ?>/profile/update">Update Profile</a></li>
                        <li><a href="<?= $basePath ?>/logout">Logout</a></li>
                </ul>
            </li>
            </ul>
        </nav>
        <?php elseif (isset($_SESSION['user']) && is_array($_SESSION['user']) && ($_SESSION['user']['is_alumni'] ?? 0) != 1): ?>
            <a class="btn-getstarted" href="<?= $basePath ?>/admin">Dashboard</a>

        <?php else: ?>
            <a class="btn-getstarted" href="<?= $basePath ?>/login">Get Started</a>
        <?php endif; ?>
        
    </div>
</header>

