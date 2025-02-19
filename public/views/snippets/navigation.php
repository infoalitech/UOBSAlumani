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
                <!-- <li><a href="<?= $basePath ?>/contact">Contact</a></li> -->
                <!-- <li class="dropdown">
                    <a href="#"><span>More</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> -->
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="<?= $basePath ?>/admin/dashboard">Get Started</a>

    </div>
</header>

