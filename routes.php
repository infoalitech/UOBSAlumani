<?php
/* routes.php */
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'middleware/auth.php';
require_once 'middleware/permission.php';
require_once 'app/Controllers/HomeController.php';

use App\Controllers\HomeController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate and store secret key if not set
if (!isset($_SESSION['secret_key'])) {
    $_SESSION['secret_key'] = bin2hex(random_bytes(32));
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = hash_hmac('sha256', session_id(), $_SESSION['secret_key']);
}

function validateCsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }
}
$loader = new FilesystemLoader(__DIR__ . '/../app/Views/templates');
$twig = new Environment($loader);

// Define routes
$page = $_GET['page'] ?? trim($_SERVER['REQUEST_URI'], '/');

print($page);
exit();
switch ($page) {
    case 'dashboard':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'jobs':
        $controller = new HomeController();
        $controller->jobs();
        break;
    case 'posts':
        $controller = new HomeController();
        $controller->posts();
        break;
    case 'blogs':
        requireAuth();
        checkPermission('view_blogs');
        echo $twig->render('blogs.twig', ['csrf_token' => $_SESSION['csrf_token']]);
        break;
    case 'users':
        requireAuth();
        checkPermission('view_users');
        echo $twig->render('users.twig', ['csrf_token' => $_SESSION['csrf_token']]);
        break;
    default:
        echo $twig->render('404.twig');
        break;
}
