<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
require_once '../vendor/autoload.php'; // Include Composer autoload

// Use the appropriate namespaces
use Admin\Controllers\BlogController;
use Admin\Controllers\NewsController;
use Admin\Controllers\JobsController;
use Admin\Controllers\AuthController;

// Instantiate the controllers
$blogController = new BlogController();
$newsController = new NewsController();
$jobsController = new JobsController();
$authController = new AuthController();

// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = "/UOBSAlumani/php-crud-app/public"; // Base path for routing

switch ($requestUri) {
    case "$basePath/":
    case "$basePath/index.php":
        include 'views/home.php';
        break;

    case "$basePath/about":
        include 'views/about.php';
        break;

    /** 🔹 Blog Routes */
    case "$basePath/blogs":
        $blogController->index();
        break;
    
    case "$basePath/blogs/create":
        $blogController->create();
        break;

    case "$basePath/blogs/edit":
        if (isset($_GET['id'])) {
            $blogController->edit($_GET['id']);
        } else {
            include 'views/404.php';
        }
        break;

    case "$basePath/blogs/delete":
        if (isset($_GET['id'])) {
            $blogController->delete($_GET['id']);
        } else {
            include 'views/404.php';
        }
        break;

    case "$basePath/blog/fetch":
        $blogController->fetchBlogs(); // AJAX request handler for DataTables
        break;

    /** 🔹 News Routes */
    case "$basePath/news":
        $newsController->index();
        break;

    /** 🔹 Jobs Routes */
    case "$basePath/jobs":
        $jobsController->index();
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

    /** 🔹 Default: 404 Not Found */
    default:
        include 'views/404.php';
        break;
}
?>
