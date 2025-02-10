<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../database/Database.php';
// require_once __DIR__ . '/../security.php';
require_once __DIR__ . '/../routes.php';
// print_r( $controller);

exit();
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load Twig Template Engine
$loader = new FilesystemLoader(__DIR__ . '/../app/Views/templates');
$twig = new Environment($loader);

// Load Requested Page
$page = $_GET['page'] ?? 'dashboard';

include __DIR__ . '/../routes.php';
