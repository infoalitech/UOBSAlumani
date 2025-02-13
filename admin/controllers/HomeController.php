<?php
namespace Admin\Controllers;

use App\Helpers\Config; // Import the Config class

class HomeController {
    private $basePath;
    private $displayErrors;

    public function __construct()
    {
        // Assign values to class properties
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/') . '/';
        $this->displayErrors = Config::get('DISPLAY_ERRORS', false);
    }

    public function home(){
        include(__DIR__.'/../../public/views/home.php');
    }

    public function about(){
        include(__DIR__.'/../../public/views/about.php');
    }

    public function blogs(){
        include(__DIR__.'/../../public/views/blogs.php');
    }

    public function blogDetail(){
        include(__DIR__.'/../../public/views/blogDetail.php');
    }

    public function news(){
        include(__DIR__.'/../../public/views/news.php');
    }

    public function newsDetail(){
        include(__DIR__.'/../../public/views/newsDetail.php');
    }

    public function jobs(){
        include(__DIR__.'/../../public/views/jobs.php');
    }

    public function jobsDetail(){
        include(__DIR__.'/../../public/views/jobsDetail.php');
    }
}
?>
