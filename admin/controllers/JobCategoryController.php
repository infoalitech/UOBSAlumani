<?php
namespace Admin\Controllers;

use Admin\Models\JobCategory;

class JobCategoryController {
    private $jobCategoryModel;

    public function __construct() {
        $this->jobCategoryModel = new JobCategory();
    }

    public function index() {
        $categories = $this->jobCategoryModel->getAllCategories();
        require '../views/job_categories/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobCategoryModel->createCategory($name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_categories/create.php';
    }

    public function edit($id) {
        $category = $this->jobCategoryModel->getCategoryById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobCategoryModel->updateCategory($id, $name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_categories/edit.php';
    }

    public function delete($id) {
        $this->jobCategoryModel->deleteCategory($id);
        header('Location: index.php');
        exit;
    }
}
?>