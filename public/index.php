<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require_once '../config/database.php';
require_once '../vendor/autoload.php'; // Include Composer autoload

use Admin\Controllers\BlogController;
use Admin\Controllers\NewsController;
use Admin\Controllers\JobsController;
use Admin\Controllers\AuthController;
use Admin\Controllers\HomeController;
use Admin\Controllers\DashboardController;
use App\Helpers\Config; // Import the Config class

$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);

// Get BASE_PATH and DISPLAY_ERRORS from .env using config helper
// Set error display settings based on .env
if ($displayErrors) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Use the appropriate namespaces


// Instantiate controllers
$blogController = new BlogController();
$newsController = new NewsController();
$jobsController = new JobsController();
$authController = new AuthController();
$homeController = new HomeController();
$dashboardController = new DashboardController();

// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route handling
switch ($requestUri) {
    /** ========================== PUBLIC ROUTES ========================== */
    case "$basePath/index":
        $homeController->home();
        break;

    case "$basePath/about":
        $homeController->about();
        break;

    /** 🔹 Blog Routes */
    case "$basePath/blogs":

        $homeController->blogs();
        break;
    case "$basePath/blogs/details":
        $homeController->blogDetail();
        break;

    /** 🔹 News Routes */
    case "$basePath/news":
        $homeController->news();
        break;
    case "$basePath/news/details":
        $homeController->newsDetail();
        break;

    /** 🔹 Jobs Routes */
    case "$basePath/jobs":
        $homeController->jobs();
        break;
    case "$basePath/jobs/details":
        $homeController->jobsDetail();
        break;

    /** 🔹 Authentication Routes */
    case "$basePath/login":
        include 'views/login.php';
        break;
    case "$basePath/login_handler.php":
        $authController->login();
        break;
    case "$basePath/logout":
        $authController->logout();
        break;

    /** ========================== ADMIN ROUTES ========================== */

    case "$basePath/admin":
        $dashboardController->dashboard();
        break;
    case "$basePath/admin/index":
        $dashboardController->dashboard();
        break;
    case "$basePath/admin/dashboard":
        $dashboardController->dashboard();
        break;


    case "$basePath/admin/blogs":
        $blogController->index();
        break;
    case "$basePath/admin/blogs/create":
        $blogController->create();
        break;
    case "$basePath/admin/blogs/edit":
        isset($_GET['id']) ? $blogController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blogs/delete":
        isset($_GET['id']) ? $blogController->delete($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blog/fetch":
        $blogController->fetchBlogs(); // AJAX request handler for DataTables
        break;

    /** ========================== 404 NOT FOUND ========================== */

    default:
        $homeController->home();

        // include 'views/404.php';
        break;
}
