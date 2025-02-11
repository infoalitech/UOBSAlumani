<?php
session_start();

require_once '../src/config/database.php';
require_once '../src/controllers/AuthController.php';
require_once '../src/controllers/HomeController.php';
require_once '../src/controllers/BlogController.php';
require_once '../src/controllers/NewsController.php';
require_once '../src/controllers/JobController.php';

$authController = new AuthController();
$homeController = new HomeController();
$blogController = new BlogController();
$newsController = new NewsController();
$jobController = new JobController();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'register':
        $authController->register();
        break;
    case 'home':
        $homeController->index();
        break;
    case 'blogs':
        $blogController->index();
        break;
    case 'news':
        $newsController->index();
        break;
    case 'jobs':
        $jobController->index();
        break;
    case 'job_detail':
        $jobController->show($_GET['id']);
        break;
    default:
        $homeController->index();
        break;
}
?>