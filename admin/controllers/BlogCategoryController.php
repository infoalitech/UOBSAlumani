<?php
namespace Admin\Controllers;

use Admin\Models\BlogCategory;

class BlogCategoryController extends BaseController {
    private $blogCategoryModel;
    private $perPage = 5;

    public function __construct() {
        parent::__construct();
        $this->blogCategoryModel = new BlogCategory($this->db);
    }

    /**
     * Display all blog categories
     */
    public function index() {
        $categories = $this->blogCategoryModel->getAllCategories();
        $this->adminView('blog_categories/index', ['categories' => $categories]);
    }

    /**
     * Fetch blog categories for AJAX DataTables
     */
    public function fetchCategories() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalCategories = $this->blogCategoryModel->getCategoryCount($search);
        $pagination = $this->getPaginationData($totalCategories, $search);
        $filteredCategories = $this->blogCategoryModel->getPaginatedCategories($pagination['limit'], $pagination['start'], $search);
    
        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalCategories,
            "recordsFiltered" => $totalCategories,
            "data" => $filteredCategories
        ]);
    }
    
    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($this->blogCategoryModel->createCategory($name)) {
                $this->redirect('/admin/blog_categories');
            }
        }
        $this->adminView('blog_categories/create');
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $category = $this->blogCategoryModel->getCategoryById($id);

        if (!$category) {
            die("Category not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($this->blogCategoryModel->updateCategory($id, $name)) {
                $this->redirect('/admin/blog_categories');
            }
        }
        $this->adminView('blog_categories/edit', ['category' => $category]);
    }

    /**
     * Show category details
     */
    public function detail($id) {
        $category = $this->blogCategoryModel->getCategoryById($id);

        if (!$category) {
            die("Category not found.");
        }

        $this->adminView('blog_categories/detail', ['category' => $category]);
    }

    /**
     * Delete a blog category
     */
    public function delete($id) {
        $this->blogCategoryModel->deleteCategory($id);
        $this->redirect('/admin/blog_categories');
    }
}
?>
