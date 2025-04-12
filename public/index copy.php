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
$alumniJobController = new AlumniJobController();


// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function AuthCheck($basePath,$permission = null){
    if (!isset($_SESSION['username'])) {
        header('Location: '.$basePath.'/login');
        exit;
    }
}
function PermissionCheck($basePath,$permission): bool
{

    if ($_SESSION['is_alumni']) {
        header('Location: ' . $basePath . '/'); // Redirect to an unauthorized page
        return false;
    }
    if( $_SESSION['user']['status'] === 'active' && $_SESSION['user']['approved'] === 'accepted'){
        header('Location: ' . $basePath . '/'); // Redirect to an unauthorized page

        return true;
    }

    if( $_SESSION['is_super_user']){
        return true;
    }
    if (!isset($_SESSION['permissions']) || empty($_SESSION['permissions'])) {
        header('Location: ' . $basePath . '/'); // Redirect to an unauthorized page
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
        $alumniJobController->list();
        break;
    case "$basePath/alumni/job/create":
        $alumniJobController->create();
        break;
    case "$basePath/alumni/job/store":
        $alumniJobController->store();
        break;







        
    /** ========================== ADMIN ROUTES ========================== */

    /** 🔹 Dashboard */
    case "$basePath/admin":
    case "$basePath/admin/":
    case "$basePath/admin/index":
    case "$basePath/admin/dashboard":
        PermissionCheck($basePath,'access_dashboard');
        AuthCheck($basePath, 'access_dashboard');
        $dashboardController->dashboard();
        break;

    /** 🔹 User Management */
    case "$basePath/admin/users":
        PermissionCheck($basePath,'view_users');
        AuthCheck($basePath, 'view_users');
        $userController->index();
        break;
    case "$basePath/admin/users/fetch":
        PermissionCheck($basePath,'view_users');
        AuthCheck($basePath, 'view_users');
        $userController->fetchUsers(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/users/detail":
        PermissionCheck($basePath,'view_users');
        AuthCheck($basePath, 'view_users');
        isset($_GET['id']) ? $userController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/users/create":
        PermissionCheck($basePath,'create_users');
        AuthCheck($basePath, 'create_users');
        $userController->create();
        break;
    case "$basePath/admin/users/edit":
        PermissionCheck($basePath,'edit_users');
        AuthCheck($basePath, 'edit_users');
        isset($_GET['id']) ? $userController->edit($_GET['id']) : include 'views/404.php';
        break;
        AuthCheck($basePath);
    case "$basePath/admin/users/delete":
        PermissionCheck($basePath,'delete_users');
        AuthCheck($basePath, 'delete_users');
        isset($_GET['id']) ? $userController->delete($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/users/status":
        PermissionCheck($basePath,'delete_users');
        AuthCheck($basePath, 'delete_users');
        isset($_GET['id']) ? $userController->updateStatus($_GET['id'], $_GET['status']) : include 'views/404.php';
        break;
    

    /** 🔹 Permissions */
    case "$basePath/admin/permissions":
        PermissionCheck($basePath,'view_permissions');
        AuthCheck($basePath, 'view_permissions');
        $permissionController->index();
        break;

    /** 🔹 Blogs */
    case "$basePath/admin/blogs":
        PermissionCheck($basePath,'view_admin_blogs');
        AuthCheck($basePath, 'view_admin_blogs');
        $blogController->index();
        break;
    case "$basePath/admin/blog/fetch":
        PermissionCheck($basePath,'view_admin_blogs');
        AuthCheck($basePath, 'view_admin_blogs');
        $blogController->fetchBlogs(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/blogs/detail":
        PermissionCheck($basePath,'view_admin_blogs');
        AuthCheck($basePath, 'view_admin_blogs');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blogs/create":
        PermissionCheck($basePath,'create_blogs');
        AuthCheck($basePath, 'create_blogs');
        $blogController->create();
        break;

    case "$basePath/admin/blogs/edit":
        PermissionCheck($basePath,'edit_blogs');
        AuthCheck($basePath, 'edit_blogs');
        isset($_GET['id']) ? $blogController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blogs/delete":
        PermissionCheck($basePath,'delete_blogs');
        AuthCheck($basePath, 'delete_blogs');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Blog Categories */
    case "$basePath/admin/blog/categories":
        PermissionCheck($basePath,'view_blog_categories');
        AuthCheck($basePath, 'view_blog_categories');
        $blogCategoryController->index();
        break;
    case "$basePath/admin/blog/categories/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);

        $blogCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/blog/categories/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);

        isset($_GET['id']) ? $blogCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blog/categories/create":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $blogCategoryController->create();
        break;
    case "$basePath/admin/blog/categories/edit":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/blog/categories/delete":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $blogCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Jobs */
    case "$basePath/admin/jobs":
        PermissionCheck($basePath,'view_admin_jobs');
        AuthCheck($basePath, 'view_admin_jobs');
        $jobPostsController->index();
        break;
    case "$basePath/admin/jobs/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobPostsController->fetchJobPosts(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobPostsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/create":
        PermissionCheck($basePath,'create_jobs');
        AuthCheck($basePath, 'create_jobs');
        $jobPostsController->create();
        break;
    case "$basePath/admin/jobs/edit":
        PermissionCheck($basePath,'edit_jobs');
        AuthCheck($basePath, 'edit_jobs');
        isset($_GET['id']) ? $jobPostsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/delete":
        PermissionCheck($basePath,'delete_jobs');
        AuthCheck($basePath, 'delete_jobs');
        isset($_GET['id']) ? $jobPostsController->delete($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/status":
        PermissionCheck($basePath,'delete_jobs');
        AuthCheck($basePath, 'delete_jobs');
        isset($_GET['id']) ? $jobPostsController->updateStatus($_GET['id'],$_GET['status']) : include 'views/404.php';
        break;

    /** 🔹 Job Categories */
    case "$basePath/admin/jobs/categories":
        PermissionCheck($basePath,'view_job_categories');
        AuthCheck($basePath, 'view_job_categories');
        $jobCategoryController->index();
        break;
    case "$basePath/admin/jobs/categories/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobCategoryController->fetchCategories(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/categories/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/categories/create":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobCategoryController->create();
        break;
    case "$basePath/admin/jobs/categories/edit":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/categories/delete":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobCategoryController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job education */
    case "$basePath/admin/jobs/education":
        PermissionCheck($basePath,'view_job_education');
        AuthCheck($basePath, 'view_job_education');
        $jobEducationLevelController->index();
        break;
    case "$basePath/admin/jobs/education/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobEducationLevelController->fetchEducationLevels(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/education/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/education/create":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobEducationLevelController->create();
        break;
    case "$basePath/admin/jobs/education/edit":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/education/delete":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobEducationLevelController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 Job fields */
    case "$basePath/admin/jobs/fields":
        PermissionCheck($basePath,'view_job_fields');
        AuthCheck($basePath, 'view_job_fields');
        $jobFieldController->index();
        break;

    case "$basePath/admin/jobs/fields/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobFieldController->fetchFields(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/fields/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/fields/create":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobFieldController->create();
        break;
    case "$basePath/admin/jobs/fields/edit":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/fields/delete":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobFieldController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/jobs/types":
        PermissionCheck($basePath,'view_job_types');
        AuthCheck($basePath, 'view_job_types');
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobTypeController->index();
        break;
    case "$basePath/admin/jobs/type/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobTypeController->fetchJobTypes(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/jobs/type/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/create":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $jobTypeController->create();
        break;
    case "$basePath/admin/jobs/type/edit":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/jobs/type/delete":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $jobTypeController->delete($_GET['id']) : include 'views/404.php';
        break;

    /** 🔹 Job Types */
    case "$basePath/admin/news":
        PermissionCheck($basePath,'view_admin_news');
        AuthCheck($basePath, 'view_admin_news');
        $newsController->index();
        break;
    case "$basePath/admin/news/fetch":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        $newsController->fetchNews(); // AJAX request handler for DataTables
        break;
    case "$basePath/admin/news/detail":
        PermissionCheck($basePath,'basePat');
        AuthCheck($basePath);
        isset($_GET['id']) ? $newsController->detail($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/create":
        PermissionCheck($basePath,'create_news');
        AuthCheck($basePath, 'create_news');
        $newsController->create();
        break;
    case "$basePath/admin/news/edit":
        PermissionCheck($basePath,'edit_news');
        AuthCheck($basePath, 'edit_news');
        isset($_GET['id']) ? $newsController->edit($_GET['id']) : include 'views/404.php';
        break;
    case "$basePath/admin/news/delete":
        PermissionCheck($basePath,'delete_news');
        AuthCheck($basePath, 'delete_news');
        isset($_GET['id']) ? $newsController->delete($_GET['id']) : include 'views/404.php';
        break;


    /** 🔹 404 - Not Found */
    default:
        include 'views/404.php';
        break;
}
