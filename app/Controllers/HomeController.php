<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController {
    private $twig;

    public function __construct() {
        require_once __DIR__ . '/../../vendor/autoload.php'; // Ensure autoload is included
        $loader = new FilesystemLoader(__DIR__ . '/../Views/templates');
        $this->twig = new Environment($loader);
    }

    public function index() {

        echo $this->twig->render('dashboard.twig');
    }
    public function jobs() {
        print($page);
echo"<pre>



";
exit();
        echo $this->twig->render('jobs.twig');
    }
    public function posts() {
        echo $this->twig->render('posts.twig');
    }
}

// Instantiate and show the dashboard
$controller = new HomeController();
$controller->index();
