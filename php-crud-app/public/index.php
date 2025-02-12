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

// Include routing logic or load the appropriate page based on the request
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($requestUri) {
    case '/UOBSAlumani/php-crud-app/public/':
    case '/UOBSAlumani/php-crud-app/public/index.php':
        // Load the home page
        include 'views/home.php';
        break;
    case '/UOBSAlumani/php-crud-app/public/about':
        // Load the about page
        include 'views/about.php';
        break;
    case '/UOBSAlumani/php-crud-app/public/jobs':
        // Call the jobs controller index method
        $jobsController->index();
        break;
    case '/UOBSAlumani/php-crud-app/public/blogs':
        // Call the blog controller index method
        $blogController->index();
        break;
    case '/UOBSAlumani/php-crud-app/public/news':
        // Call the news controller index method
        $newsController->index();
        break;
    case '/UOBSAlumani/php-crud-app/public/login':
        // Load the login page
        include 'views/login.php';
        break;
    case '/UOBSAlumani/php-crud-app/public/login_handler.php':
        // Handle the login form submission
        $authController->login();
        break;
    case '/UOBSAlumani/php-crud-app/public/logout':
        // Handle the logout process
        $authController->logout();
        break;
    // Add more routes as needed
    default:
        // Load a 404 page or redirect to home
        include 'views/404.php';
        break;
}
?>