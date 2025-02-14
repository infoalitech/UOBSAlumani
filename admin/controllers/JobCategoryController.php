<?php
namespace Admin\Controllers;

use Admin\Models\JobCategory;

class JobCategoryController extends BaseController {
    private $jobCategoryModel;

    public function __construct() {
        parent::__construct();
        $this->jobCategoryModel = new JobCategory($this->db);
    }

    /**
     * Display all job categories
     */
    public function index() {
        $categories = $this->jobCategoryModel->getAllCategories();
        $this->adminView('JobsCategories/index', ['categories' => $categories]);
    }

    /**
     * Fetch job categories for AJAX DataTables
     */
    public function fetchCategories() {
        header('Content-Type: application/json');

        $draw = isset($_GET['draw']) ? (int)$_GET['draw'] : 1;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
        $start = isset($_GET['start']) ? (int)$_GET['start'] : ($page - 1) * $limit;
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';

        $totalCategories = $this->jobCategoryModel->getCategoryCount($search);
        $filteredCategories = $this->jobCategoryModel->getPaginatedCategories($limit, $start, $search);

        echo json_encode([
            "draw" => $draw,
            "page" => $page,
            "recordsTotal" => $totalCategories,
            "recordsFiltered" => $totalCategories,
            "data" => $filteredCategories
        ]);
    }

    /**
     * Show create category form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $status = $_POST['status'];

            if (empty($name) || !in_array($status, ['active', 'inactive'])) {
                $error = "Invalid input. Please check your data.";
            } else {
                if ($this->jobCategoryModel->createCategory($name, $status)) {
                    header('Location: index.php');
                    exit;
                } else {
                    $error = "Failed to create category. Try again.";
                }
            }
        }
        $this->adminView('JobsCategories/create');
    }

    /**
     * Show edit category form and handle update
     */
    public function edit($id) {
        $category = $this->jobCategoryModel->getCategoryById($id);

        if (!$category) {
            die("Category not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $status = $_POST['status'];

            if (empty($name) || !in_array($status, ['active', 'inactive'])) {
                $error = "Invalid input. Please check your data.";
            } else {
                if ($this->jobCategoryModel->updateCategory($id, $name, $status)) {
                    header('Location: index.php');
                    exit;
                } else {
                    $error = "Failed to update category.";
                }
            }
        }
        $this->adminView('JobsCategories/edit', ['category' => $category]);
    }

    /**
     * Show category details
     */
    public function detail($id) {
        $category = $this->jobCategoryModel->getCategoryById($id);
        require '../views/JobsCategories/detail.php';
    }

    /**
     * Delete a category
     */
    public function delete($id) {
        if ($this->jobCategoryModel->deleteCategory($id)) {
            header('Location: index.php');
            exit;
        } else {
            die("Failed to delete category.");
        }
    }
}
?>
