<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\News;
use Admin\Models\JobPost;
use App\Helpers\Config;

class HomeController {
    private $basePath;
    private $displayErrors;
    private $blogModel;
    private $newsModel;
    private $jobModel;

    public function __construct() {
        // Assign values to class properties
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/') . '/';
        $this->displayErrors = Config::get('DISPLAY_ERRORS', false);

        // Initialize models
        $db = require __DIR__ . '/../../config/database.php';
        $this->blogModel = new Blog($db);
        $this->newsModel = new News($db);
        $this->jobModel = new JobPost($db);
    }

    public function home() {
        // Fetch latest content
        $latestBlogs = $this->blogModel->getLatestBlogs(3);
        $latestNews = $this->newsModel->getLatestNews(3);
        $latestJobs = $this->jobModel->getLatestJobs(3);

        include(__DIR__.'/../../public/views/home.php');
    }

    public function contact() {
        include(__DIR__.'/../../public/views/contact.php');
    }

    public function about() {
        include(__DIR__.'/../../public/views/about.php');
    }

    public function blogs() {
        $blogs = $this->blogModel->getAllBlogs();
        include(__DIR__.'/../../public/views/blogs.php');
    }

    public function blogDetail($id) {
        $blog = $this->blogModel->getBlogById($id);
        include(__DIR__.'/../../public/views/blogDetail.php');
    }

    public function news() {
        $news = $this->newsModel->getAllNews();
        include(__DIR__.'/../../public/views/news.php');
    }

    public function newsDetail($id) {
        $news = $this->newsModel->getNewsById($id);
        include(__DIR__.'/../../public/views/newsDetail.php');
    }

    public function jobs() {
        $jobs = $this->jobModel->getAllJobPosts();
        include(__DIR__.'/../../public/views/jobs.php');
    }

    public function jobsDetail($id) {
        $job = $this->jobModel->getJobPostById($id);
        include(__DIR__.'/../../public/views/jobsDetail.php');
    }
}
?>
