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
use Admin\Controllers\UserController;
use Admin\Controllers\PermissionController;
use Admin\Controllers\JobCategoryController;
use Admin\Controllers\JobFieldController;
use Admin\Controllers\JobTypeController;
use Admin\Controllers\JobEducationLevelController;
use Admin\Controllers\JobPostsController;
use Admin\Controllers\BlogCategoryController;
use App\Helpers\Config; // Import the Config class

// Get BASE_PATH from .env
$basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
$displayErrors = Config::get('DISPLAY_ERRORS', false);

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

// Instantiate controllers
$blogController = new BlogController();
$newsController = new NewsController();
$authController = new AuthController();
$homeController = new HomeController();
$dashboardController = new DashboardController();
$userController = new UserController();
$permissionController = new PermissionController();
$jobCategoryController = new JobCategoryController();
$jobFieldController = new JobFieldController();
$jobTypeController = new JobTypeController();
$jobEducationLevelController = new JobEducationLevelController();
$jobPostsController = new JobPostsController();
$blogCategoryController = new BlogCategoryController();
// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route handling
switch ($requestUri) {

    /** ========================== PUBLIC ROUTES ========================== */
    case "$basePath/index":
    case "$basePath/":
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

    /** 🔹 Dashboard */
    case "$basePath/admin":
    case "$basePath/admin/index":
    case "$basePath/admin/dashboard":
        $dashboardController->dashboard();
        break;

    /** 🔹 User Management */
    case "$basePath/admin/users":
        $userController->index();
        break;
    case "$basePath/admin/users/create":
        $userController->create();
        break;
    case "$basePath/admin/users/edit":
        isset($_GET['id']) ? $userController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/users/delete":
        isset($_GET['id']) ? $userController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Permissions */
    case "$basePath/admin/permissions":
        $permissionController->index();
        break;

    /** 🔹 Blogs */
    case "$basePath/admin/blogs":
        $blogController->index();
        break;
    case "$basePath/admin/blog/fetch":
        $blogController->fetchBlogs(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/blogs/detail":
        isset($_GET['id']) ? $blogController->detail($_GET['id']) : include 'views/404.php';
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


    /** 🔹 Blog Categories */
    case "$basePath/admin/blog/categories":
        $blogCategoryController->index();
        break;
    case "$basePath/admin/jobs/fetch":
        $blogCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/detail":
        isset($_GET['id']) ? $blogCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/create":
        $blogCategoryController->create();
        break;
    case "$basePath/admin/jobs/edit":
        isset($_GET['id']) ? $blogCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/delete":
        isset($_GET['id']) ? $blogCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Jobs */
    case "$basePath/admin/jobs":
        $jobPostsController->index();
        break;
    case "$basePath/admin/jobs/fetch":
        $jobPostsController->fetchJobPosts(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/detail":
        isset($_GET['id']) ? $jobPostsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/create":
        $jobPostsController->create();
        break;
    case "$basePath/admin/jobs/edit":
        isset($_GET['id']) ? $jobPostsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/delete":
        isset($_GET['id']) ? $jobPostsController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Categories */
    case "$basePath/admin/job/categories":
        $jobCategoryController->index();
        break;
    case "$basePath/admin/jobs/categories/fetch":
        $jobCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/categories/detail":
        isset($_GET['id']) ? $jobCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/categories/create":
        $jobCategoryController->create();
        break;
    case "$basePath/admin/job/categories/edit":
        isset($_GET['id']) ? $jobCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/categories/delete":
        isset($_GET['id']) ? $jobCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job education */
    case "$basePath/admin/job/education":
        $jobEducationLevelController->index();
        break;
    case "$basePath/admin/jobs/education/fetch":
        $jobEducationLevelController->fetchEducationLevels(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/education/detail":
        isset($_GET['id']) ? $jobEducationLevelController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/education/create":
        $jobEducationLevelController->create();
        break;
    case "$basePath/admin/job/education/edit":
        isset($_GET['id']) ? $jobEducationLevelController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/education/delete":
        isset($_GET['id']) ? $jobEducationLevelController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Job fields */
    case "$basePath/admin/job/fields":
        $jobFieldController->index();
        break;

    case "$basePath/admin/jobs/fields/fetch":
        $jobTypeController->fetchJobTypes(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/fields/detail":
        isset($_GET['id']) ? $jobTypeController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/fields/create":
        $jobFieldController->create();
        break;
    case "$basePath/admin/job/fields/edit":
        isset($_GET['id']) ? $jobFieldController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/job/fields/delete":
        isset($_GET['id']) ? $jobFieldController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/job/types":
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type":
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type/fetch":
        $jobTypeController->fetchJobTypes(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/type/detail":
        isset($_GET['id']) ? $jobTypeController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/create":
        $jobTypeController->create();
        break;
    case "$basePath/admin/jobs/type/edit":
        isset($_GET['id']) ? $jobTypeController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/delete":
        isset($_GET['id']) ? $jobTypeController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/news":
        $newsController->index();
        break;
    case "$basePath/admin/news/fetch":
        $newsController->fetchNews(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/news/detail":
        isset($_GET['id']) ? $newsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/create":
        $newsController->create();
        break;
    case "$basePath/admin/news/edit":
        isset($_GET['id']) ? $newsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/delete":
        isset($_GET['id']) ? $newsController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 404 - Not Found */
    default:
        include 'views/404.php';
        break;
}
