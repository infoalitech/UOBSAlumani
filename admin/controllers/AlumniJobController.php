<?php
namespace Admin\Controllers;

use Admin\Models\User;
use Admin\Models\JobPost;
use Admin\Models\JobCategory;
use Admin\Models\JobField;
use Admin\Models\JobEducationLevel;
use Admin\Models\JobType;

class AlumniJobController extends BaseController {
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
     * List all job posts submitted by alumni
     */
    public function list() {
        $jobPosts = $this->jobPostModel->getAllJobPostsByUser(); // Optionally filter by alumni
        include(__DIR__.'/../../public/views/alumni_jobs/index.php');


    }

    /**
     * Show form to create a new alumni job post
     */
    public function create() {
        $error = "";
        $categories = $this->jobCategoryModel->getAllCategories();
        $fields = $this->jobFieldModel->getAllFields();
        $levels = $this->jobEducationLevelModel->getAllLevels();
        $types = $this->jobTypeModel->getAllTypes();
        include(__DIR__.'/../../public/views/alumni_jobs/create.php');
    }

    /**
     * Store a newly submitted alumni job post
     */
    public function store() {
        $error = "";


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            
            // Optional: handle image or attachment upload
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $this->handleFileUpload($_FILES['image']);
            }

            if ($this->validateJobPostData($data)) {
                if ($this->jobPostModel->createJobPost($data)) {
                    // $this->adminView('/alumni/job/index', ['error' => $error, 'data' => $data]);

                    include(__DIR__.'/../../public/views/alumni_jobs/index.php');
                    $this->redirect('/admin/alumni-jobs');
                } else {
                    $error = "Failed to submit job post.";
                }
            } else {
                $error = "Please fill all required fields.";
            }

            $this->adminView('/alumni/job/create', ['error' => $error, 'data' => $data]);
        } else {
            $this->adminView('/alumni/job/create', ['error' => $error, 'data' => $data]);
        }
    }

    /**
     * Basic validation (you can extend this further)
     */
    private function validateJobPostData($data) {
        return !empty($data['title']) && !empty($data['organization']) && !empty($data['description']) &&
               !empty($data['open_date']) && !empty($data['last_date']);
    }


}
