<?php
namespace Admin\Controllers;

use Admin\Models\JobPost;
use Admin\Models\JobCategory;
use Admin\Models\JobField;
use Admin\Models\JobEducationLevel;
use Admin\Models\JobType;

class JobPostsController {
    private $jobPostModel;
    private $jobCategoryModel;
    private $jobFieldModel;
    private $jobEducationLevelModel;
    private $jobTypeModel;

    public function __construct() {
        $this->jobPostModel = new JobPost();
        $this->jobCategoryModel = new JobCategory();
        $this->jobFieldModel = new JobField();
        $this->jobEducationLevelModel = new JobEducationLevel();
        $this->jobTypeModel = new JobType();
    }

    public function index() {
        $jobPosts = $this->jobPostModel->getAllJobPosts();
        require '../views/job_posts/index.php';
    }

    public function create() {
        $categories = $this->jobCategoryModel->getAllCategories();
        $fields = $this->jobFieldModel->getAllFields();
        $levels = $this->jobEducationLevelModel->getAllLevels();
        $types = $this->jobTypeModel->getAllTypes();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $requirement = $_POST['requirement'];
            $organization = $_POST['organization'];
            $post_link = $_POST['post_link'];
            $apply_link = $_POST['apply_link'];
            $type_id = $_POST['type_id'];
            $category_id = $_POST['category_id'];
            $field_id = $_POST['field_id'];
            $level_id = $_POST['level_id'];
            $country = $_POST['country'];
            $open_date = $_POST['open_date'];
            $last_date = $_POST['last_date'];
            $inserted_by = $_POST['inserted_by'];

            if ($this->jobPostModel->createJobPost($title, $desc, $requirement, $organization, $post_link, $apply_link, $type_id, $category_id, $field_id, $level_id, $country, $open_date, $last_date, $inserted_by)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_posts/create.php';
    }

    public function edit($id) {
        $jobPost = $this->jobPostModel->getJobPostById($id);
        $categories = $this->jobCategoryModel->getAllCategories();
        $fields = $this->jobFieldModel->getAllFields();
        $levels = $this->jobEducationLevelModel->getAllLevels();
        $types = $this->jobTypeModel->getAllTypes();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $requirement = $_POST['requirement'];
            $organization = $_POST['organization'];
            $post_link = $_POST['post_link'];
            $apply_link = $_POST['apply_link'];
            $type_id = $_POST['type_id'];
            $category_id = $_POST['category_id'];
            $field_id = $_POST['field_id'];
            $level_id = $_POST['level_id'];
            $country = $_POST['country'];
            $open_date = $_POST['open_date'];
            $last_date = $_POST['last_date'];
            $inserted_by = $_POST['inserted_by'];

            if ($this->jobPostModel->updateJobPost($id, $title, $desc, $requirement, $organization, $post_link, $apply_link, $type_id, $category_id, $field_id, $level_id, $country, $open_date, $last_date, $inserted_by)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_posts/edit.php';
    }

    public function delete($id) {
        $this->jobPostModel->deleteJobPost($id);
        header('Location: index.php');
        exit;
    }
}
?>