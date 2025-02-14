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

    /**
     * Fetch job posts for AJAX DataTables
     */
    public function fetchJobPosts() {
        header('Content-Type: application/json');

        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalJobs = $this->jobPostModel->getJobPostCount($search);
        $pagination = $this->getPaginationData($totalJobs, $search);
        $filteredJobs = $this->jobPostModel->getPaginatedJobPosts($pagination['limit'], $pagination['start'], $search);

        echo json_encode([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalJobs,
            "recordsFiltered" => $totalJobs,
            "data" => $filteredJobs
        ]);
        exit;
    }

    /**
     * Show details of a specific job post
     */
    public function detail($id) {
        $jobPost = $this->jobPostModel->getJobPostById($id);

        if (!$jobPost) {
            $this->redirect('/admin/job_posts', ['error' => 'Job Post not found.']);
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

        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Handle Image Upload
            $data['image'] = $this->handleFileUpload($_FILES['image']);

            if ($this->validateJobPostData($data)) {
                if ($this->jobPostModel->createJobPost($data)) {
                    $this->redirect('/admin/jobs');
                } else {
                    $error = "Failed to create job post.";
                }
            } else {
                $error = "Invalid input. Please check your data.";
            }
        }
        $this->adminView('job_posts/create', compact('categories', 'fields', 'levels', 'types', 'error'));
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

        if (!$jobPost) {
            $this->redirect('/admin/job_posts', ['error' => 'Job Post not found.']);
        }

        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Handle Image Upload (Only if a new file is uploaded)
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $this->handleFileUpload($_FILES['image']);
            } else {
                $data['image'] = $jobPost['image']; // Keep existing image
            }

            if ($this->validateJobPostData($data)) {
                if ($this->jobPostModel->updateJobPost($id, $data)) {
                    $this->redirect('/admin/jobs');
                } else {
                    $error = "Failed to update job post.";
                }
            } else {
                $error = "Invalid input. Please check your data.";
            }
        }
        $this->adminView('job_posts/edit', compact('jobPost', 'categories', 'fields', 'levels', 'types', 'error'));
    }

    /**
     * Delete a job post
     */
    public function delete($id) {
        if ($this->jobPostModel->deleteJobPost($id)) {
            $this->redirect('/admin/jobs');
        } else {
            $this->redirect('/admin/job_posts', ['error' => 'Failed to delete job post.']);
        }
    }

    /**
     * Validate job post input data
     */
    private function validateJobPostData($data) {
        if (empty($data['title']) || empty($data['organization']) || empty($data['category_id']) ||
            empty($data['field_id']) || empty($data['level_id']) || empty($data['type_id']) ||
            empty($data['open_date']) || empty($data['last_date'])) {
            return false;
        }
        return true;
    }

}
?>
