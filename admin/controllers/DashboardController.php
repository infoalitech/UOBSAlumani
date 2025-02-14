<?php
namespace Admin\Controllers;

use Admin\Models\User;
use Admin\Models\Blog;
use Admin\Models\News;
use Admin\Models\JobPost;
use Admin\Models\JobCategory;
use Admin\Models\JobType;
use App\Helpers\Config;

class DashboardController extends BaseController {
    protected $basePath;
    private $displayErrors;
    private $userModel;
    private $blogModel;
    private $newsModel;
    private $jobPostModel;
    private $jobCategoryModel;
    private $jobTypeModel;

    public function __construct() {
        parent::__construct();
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/') . '/';
        $this->displayErrors = Config::get('DISPLAY_ERRORS', false);

        // Initialize models
        $this->userModel = new User($this->db);
        $this->blogModel = new Blog($this->db);
        $this->newsModel = new News($this->db);
        $this->jobPostModel = new JobPost($this->db);
        $this->jobCategoryModel = new JobCategory($this->db);
        $this->jobTypeModel = new JobType($this->db);
    }

    public function dashboard() {
        // Fetch overall statistics
        $stats = [
            'totalUsers' => $this->userModel->getUserCount(),
            'totalBlogs' => $this->blogModel->getBlogCount(),
            'totalNews' => $this->newsModel->getNewsCount(),
            'totalJobs' => $this->jobPostModel->getJobPostCount(),
            'totalCategories' => $this->jobCategoryModel->getCategoryCount(),
            'totalJobTypes' => $this->jobTypeModel->getTypeCount(),
        ];

        // Fetch engagement statistics
        $engagementStats = [
            'totalBlogViews' => $this->blogModel->getTotalViews(),
            'totalBlogLikes' => $this->blogModel->getTotalLikes(),
            'totalBlogClicks' => $this->blogModel->getTotalClicks(),
            'totalNewsViews' => $this->newsModel->getTotalViews(),
            'totalNewsLikes' => $this->newsModel->getTotalLikes(),
            'totalNewsClicks' => $this->newsModel->getTotalClicks(),
            'totalJobViews' => $this->jobPostModel->getTotalViews(),
            'totalJobClicks' => $this->jobPostModel->getTotalClicks(),
        ];

        // Fetch latest entries
        $latestEntries = [
            'latestBlogs' => $this->blogModel->getPaginatedBlogs(5, 0),
            'latestNews' => $this->newsModel->getPaginatedNews(5, 0),
            'latestJobs' => $this->jobPostModel->getPaginatedJobPosts(5, 0),
        ];

        $this->adminView('dashboard', array_merge($stats, $engagementStats, $latestEntries));
    }
}
?>
