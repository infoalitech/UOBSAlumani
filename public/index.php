<?php
session_start();
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
use Admin\Controllers\AlumniRegistrationController;
use Admin\Controllers\AlumniJobController;
use App\Helpers\Config; // Import the Config class

// Get BASE_PATH from .env
$basePath = rtrim(Config::get('BASE_PATH', '/public'), '/');
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
$alumniRegistrationController = new AlumniRegistrationController();
// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function AuthCheck($basePath,$permission = null){
    if (!isset($_SESSION['username'])) {
        header('Location: '.$basePath.'/login');
        exit;
    }
    if($permission != null){

    }

}
function PermissionCheck($permission): bool
{

    if( $_SESSION['is_super_user']){
        return true;
    }

    global $basePath; // Ensure $basePath is accessible
    if (!isset($_SESSION['permissions']) || empty($_SESSION['permissions'])) {
        header('Location: ' . $basePath . '/login');
        exit;
    }
    
    // Extract permission names from the session
    $userPermissions = array_column($_SESSION['permissions'], 'name');
    // Check if the required permission exists in the user's permissions
    if (in_array($permission, $userPermissions)) {
        return true;
    }
    // Redirect if the user lacks the required permission
    header('Location: ' . $basePath . '/unauthorized'); // Redirect to an unauthorized page
    exit;
}



$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// ✅ Define public-access folders to bypass (assets, vendor, etc.)
$publicFolders = [$basePath.'assets', $basePath.'vendor',$basePath.'../vendor',$basePath.'css',$basePath.'js'];

foreach ($publicFolders as $folder) {
    if (preg_match("#^/UOBSAlumani/{$folder}/#", $path)) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $path;
        if (file_exists($file)) {
            return false; // Serve static file directly
        }
    }
}
// Route handling
switch ($requestUri) {

    /** ========================== PUBLIC ROUTES ========================== */
    case "$basePath/index.php":
    case "$basePath/index":
    case "$basePath/home":
    case "$basePath/":
        $homeController->home();
        break;

    case "$basePath/convocations":
        $homeController->about();
        break;

    case "$basePath/contact":
        $homeController->contact();
        break;

    /** 🔹 Blog Routes */
    case "$basePath/blogs":
        $homeController->blogs();
        break;

    case "$basePath/blogs/details":
        $homeController->blogDetail($_GET['id']);
        break;

    /** 🔹 News Routes */
    case "$basePath/news":
        $homeController->news();
        break;
    case "$basePath/news/details":
        $homeController->newsDetail($_GET['id']);
        break;

    /** 🔹 Jobs Routes */
    case "$basePath/jobs":
        $homeController->jobs();
        break;
    case "$basePath/fetchFilteredJobs":
        $homeController->fetchFilteredJobs();
        break;

    case "$basePath/jobs/details":
        $homeController->jobsDetail( $_GET['id']);
        break;

        
    /** 🔹 Authentication Routes */
    case "$basePath/login":
        if (isset($_SESSION['username'])) {
            header('Location: '.$basePath.'/admin/dashboard');
            exit;
        }
        include 'views/login.php';
        break;

    case "$basePath/register":
        if (isset($_SESSION['username'])) {
            header('Location: '.$basePath.'/');
            exit;
        }
        include 'views/register.php';
        break;
    case "$basePath/register_handler":
        $alumniRegistrationController->handleRegister($basePath);
        break;
    case "$basePath/login_handler":
        $authController->login($basePath);
        break;
    case "$basePath/logout":
        $authController->logout();
        break;

    case "$basePath/profile/update":
        $alumniRegistrationController->updateProfileForm();
        break;
    case "$basePath/update_profile_handler":
        $alumniRegistrationController->updateProfileHandler($basePath);
        break;
    case "$basePath/profile/view":
        $alumniRegistrationController->viewProfile();
        break;
    case "$basePath/change-password":
        include 'views/change_password.php';
        break;
    case "$basePath/change_password_handler":
        $alumniRegistrationController->changePasswordHandler();
        break;
    // Alumni
    case "$basePath/alumni/job/index":
        $alumniRegistrationController->changePasswordHandler();
        break;
    case "$basePath/alumni/job/create":
        $alumniRegistrationController->changePasswordHandler();
        break;
    case "$basePath/alumni/job/store":
        $alumniRegistrationController->changePasswordHandler();
        break;


        
    /** ========================== ADMIN ROUTES ========================== */

    /** 🔹 Dashboard */
    case "$basePath/admin":
    case "$basePath/admin/":
    case "$basePath/admin/index":
    case "$basePath/admin/dashboard":
        AuthCheck($basePath, 'access_dashboard');
        $dashboardController->dashboard();
        break;

    /** 🔹 User Management */
    case "$basePath/admin/users":
        AuthCheck($basePath, 'view_users');
        $userController->index();
        break;
    case "$basePath/admin/users/fetch":
        AuthCheck($basePath, 'view_users');
        $userController->fetchUsers(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/users/detail":
        AuthCheck($basePath, 'view_users');
        isset($_GET['id']) ? $userController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/users/create":
        AuthCheck($basePath, 'create_users');
        $userController->create();
        break;
    case "$basePath/admin/users/edit":
        AuthCheck($basePath, 'edit_users');
        isset($_GET['id']) ? $userController->edit($_GET['id']) : include 'views/404.php';
        break;
        AuthCheck($basePath);
    case "$basePath/admin/users/delete":
        AuthCheck($basePath, 'delete_users');
        isset($_GET['id']) ? $userController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Permissions */
    case "$basePath/admin/permissions":
        AuthCheck($basePath, 'view_permissions');
        $permissionController->index();
        break;

    /** 🔹 Blogs */
    case "$basePath/admin/blogs":
        AuthCheck($basePath, 'view_admin_blogs');
        $blogController->index();
        break;
    case "$basePath/admin/blog/fetch":
        AuthCheck($basePath, 'view_admin_blogs');
        $blogController->fetchBlogs(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/blogs/detail":
        AuthCheck($basePath, 'view_admin_blogs');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blogs/create":
        AuthCheck($basePath, 'create_blogs');
        $blogController->create();
        break;

    case "$basePath/admin/blogs/edit":
        AuthCheck($basePath, 'edit_blogs');
        isset($_GET['id']) ? $blogController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blogs/delete":
        AuthCheck($basePath, 'delete_blogs');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Blog Categories */
    case "$basePath/admin/blog/categories":
        AuthCheck($basePath, 'view_blog_categories');
        $blogCategoryController->index();
        break;
    case "$basePath/admin/blog/categories/fetch":
        AuthCheck($basePath);

        $blogCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/blog/categories/detail":
        AuthCheck($basePath);

        isset($_GET['id']) ? $blogCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blog/categories/create":
        AuthCheck($basePath);
        $blogCategoryController->create();
        break;
    case "$basePath/admin/blog/categories/edit":
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blog/categories/delete":
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Jobs */
    case "$basePath/admin/jobs":
        AuthCheck($basePath, 'view_admin_jobs');
        $jobPostsController->index();
        break;
    case "$basePath/admin/jobs/fetch":
        AuthCheck($basePath);
        $jobPostsController->fetchJobPosts(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobPostsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/create":
        AuthCheck($basePath, 'create_jobs');
        $jobPostsController->create();
        break;
    case "$basePath/admin/jobs/edit":
        AuthCheck($basePath, 'edit_jobs');
        isset($_GET['id']) ? $jobPostsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/delete":
        AuthCheck($basePath, 'delete_jobs');
        isset($_GET['id']) ? $jobPostsController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Categories */
    case "$basePath/admin/jobs/categories":
        AuthCheck($basePath, 'view_job_categories');
        $jobCategoryController->index();
        break;
    case "$basePath/admin/jobs/categories/fetch":
        AuthCheck($basePath);
        $jobCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/categories/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/categories/create":
        AuthCheck($basePath);
        $jobCategoryController->create();
        break;
    case "$basePath/admin/jobs/categories/edit":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/categories/delete":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job education */
    case "$basePath/admin/jobs/education":
        AuthCheck($basePath, 'view_job_education');
        $jobEducationLevelController->index();
        break;
    case "$basePath/admin/jobs/education/fetch":
        AuthCheck($basePath);
        $jobEducationLevelController->fetchEducationLevels(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/education/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/education/create":
        AuthCheck($basePath);
        $jobEducationLevelController->create();
        break;
    case "$basePath/admin/jobs/education/edit":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/education/delete":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Job fields */
    case "$basePath/admin/jobs/fields":
        AuthCheck($basePath, 'view_job_fields');
        $jobFieldController->index();
        break;

    case "$basePath/admin/jobs/fields/fetch":
        AuthCheck($basePath);
        $jobFieldController->fetchFields(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/fields/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/fields/create":
        AuthCheck($basePath);
        $jobFieldController->create();
        break;
    case "$basePath/admin/jobs/fields/edit":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/fields/delete":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/jobs/types":
        AuthCheck($basePath, 'view_job_types');
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type":
        AuthCheck($basePath);
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type/fetch":
        AuthCheck($basePath);
        $jobTypeController->fetchJobTypes(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/type/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/create":
        AuthCheck($basePath);
        $jobTypeController->create();
        break;
    case "$basePath/admin/jobs/type/edit":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/delete":
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/news":
        AuthCheck($basePath, 'view_admin_news');
        $newsController->index();
        break;
    case "$basePath/admin/news/fetch":
        AuthCheck($basePath);
        $newsController->fetchNews(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/news/detail":
        AuthCheck($basePath);
        isset($_GET['id']) ? $newsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/create":
        AuthCheck($basePath, 'create_news');
        $newsController->create();
        break;
    case "$basePath/admin/news/edit":
        AuthCheck($basePath, 'edit_news');
        isset($_GET['id']) ? $newsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/delete":
        AuthCheck($basePath, 'delete_news');
        isset($_GET['id']) ? $newsController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 404 - Not Found */
    default:
        include 'views/404.php';
        break;
}
