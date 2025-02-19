<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\News;
use Admin\Models\JobPost;
use Admin\Models\JobType;
use Admin\Models\JobField;
use Admin\Models\JobCategory;
use Admin\Models\JobEducationLevel;
use App\Helpers\Config;

class HomeController {
    private $basePath;
    private $displayErrors;
    private $blogModel;
    private $newsModel;
    private $jobModel;

    private $jobType;
    private $jobPost;
    private $jobField;
    private $jobCategory;
    private $jobEducationLevel;
    private $db;

    public function __construct() {
        // Assign values to class properties
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/') . '/';
        $this->displayErrors = Config::get('DISPLAY_ERRORS', false);

        // Initialize models
        $db = require __DIR__ . '/../../config/database.php';
        $this->blogModel = new Blog($db);
        $this->newsModel = new News($db);
        $this->jobModel = new JobPost($db);
        $this->jobType = new JobType($db);

        $this->jobType = new JobType($db);
        $this->jobPost = new jobPost($db);
        $this->jobField = new JobField($db);;
        $this->jobCategory = new JobCategory($db);;
        $this->jobEducationLevel = new JobEducationLevel($db);;
        $this->db=$db;
    }

    public function home() {
        // Fetch latest content
        $latestBlogs = $this->blogModel->getLatestBlogs(3);
        $latestNews = $this->newsModel->getLatestNews(3);
        $latestJobs = $this->jobModel->getLatestJobs(3);
        $jobtypes = $this->jobType->getAllTypes(3);

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
        $latestNews = $this->newsModel->getAllNews();
        include(__DIR__.'/../../public/views/news.php');
    }

    public function newsDetail($id) {
        $news = $this->newsModel->getNewsById($id);
        include(__DIR__.'/../../public/views/newsDetail.php');
    }

    public function jobs() {

        $jobs = $this->jobModel->getAllJobPosts();
        $jobtypes = $this->jobType->getAllTypes();
        $jobFields = $this->jobField->getAllFields();
        $jobCategories = $this->jobCategory->getAllCategories();
        $jobEducationLevels = $this->jobEducationLevel->getAllLevels();

        include(__DIR__.'/../../public/views/jobs.php');
    }

    public function jobsDetail($id) {
        $job = $this->jobModel->getJobPostById($id);
        include(__DIR__.'/../../public/views/jobsDetail.php');
    }
    public function fetchFilteredJobs() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
            exit;
        }
    
        $filters = [
            'page' => $_POST['page'] ?? 1,
            'limit' => $_POST['limit'] ?? 6,
            'type' => isset($_POST['type']) ? (is_array($_POST['type']) ? $_POST['type'] : explode(',', $_POST['type'])) : [],
            'category' => isset($_POST['category']) ? (is_array($_POST['category']) ? $_POST['category'] : explode(',', $_POST['category'])) : [],
            'level' => isset($_POST['selectedJoblevels']) ? (is_array($_POST['selectedJoblevels']) ? $_POST['selectedJoblevels'] : explode(',', $_POST['selectedJoblevels'])) : [],
            'fields' => isset($_POST['selectedJobFields']) ? (is_array($_POST['selectedJobFields']) ? $_POST['selectedJobFields'] : explode(',', $_POST['selectedJobFields'])) : [],
            'search' => $_POST['search'] ?? ''
        ];

        // Debugging output to check filter values
        error_log(print_r($filters, true));
    
        // Fetch filtered jobs
        $jobs = $this->jobModel->fetchFilteredJobPosts($filters);
    
        // Ensure response is JSON formatted
        header('Content-Type: application/json');
        echo json_encode(['jobs' => $jobs]);
    }
}
?>
