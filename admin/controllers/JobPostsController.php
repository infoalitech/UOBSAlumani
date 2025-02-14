<?php
namespace Admin\Controllers;

use Admin\Models\JobPost;
use Admin\Models\JobCategory;
use Admin\Models\JobField;
use Admin\Models\JobEducationLevel;
use Admin\Models\JobType;

class JobPostsController extends BaseController {
    private $jobPostModel;
    private $jobCategoryModel;
    private $jobFieldModel;
    private $jobEducationLevelModel;
    private $jobTypeModel;

    public function __construct() {
        parent::__construct();
        $this->jobPostModel = new JobPost($this->db);
        $this->jobCategoryModel = new JobCategory($this->db);
        $this->jobFieldModel = new JobField($this->db);
        $this->jobEducationLevelModel = new JobEducationLevel($this->db);
        $this->jobTypeModel = new JobType($this->db);
    }

    /**
     * List all job posts
     */
    public function index() {
        $jobPosts = $this->jobPostModel->getAllJobPosts();
        $this->adminView('job_posts/index', ['jobPosts' => $jobPosts]);
    }
    public function fetchJobPosts() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalJobs = $this->jobPostModel->getJobPostCount($search);
        $pagination = $this->getPaginationData($totalJobs, $search);
        $filteredJobs = $this->jobPostModel->getPaginatedJobPosts($pagination['limit'], $pagination['start'], $search);
    
        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalJobs,
            "recordsFiltered" => $totalJobs,
            "data" => $filteredJobs
        ]);
    }
    
    /**
     * Show details of a specific job post
     */
    public function detail($id) {
        $jobPost = $this->jobPostModel->getJobPostById($id);

        if (!$jobPost) {
            die("Job Post not found.");
        }

        $this->adminView('job_posts/detail', ['jobPost' => $jobPost]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        $categories = $this->jobCategoryModel->getAllCategories();
        $fields = $this->jobFieldModel->getAllFields();
        $levels = $this->jobEducationLevelModel->getAllLevels();
        $types = $this->jobTypeModel->getAllTypes();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            if ($this->jobPostModel->createJobPost($data)) {
                $this->redirect('/admin/job_posts');
            }
        }
        $this->adminView('job_posts/create', compact('categories', 'fields', 'levels', 'types'));
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $jobPost = $this->jobPostModel->getJobPostById($id);
        $categories = $this->jobCategoryModel->getAllCategories();
        $fields = $this->jobFieldModel->getAllFields();
        $levels = $this->jobEducationLevelModel->getAllLevels();
        $types = $this->jobTypeModel->getAllTypes();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            if ($this->jobPostModel->updateJobPost($id, $data)) {
                $this->redirect('/admin/job_posts');
            }
        }
        $this->adminView('job_posts/edit', compact('jobPost', 'categories', 'fields', 'levels', 'types'));
    }

    /**
     * Delete a job post
     */
    public function delete($id) {
        $this->jobPostModel->deleteJobPost($id);
        $this->redirect('/admin/job_posts');
    }
}
?>
