<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\BlogCategory;

class BlogController {
    private $blogModel;
    private $blogCategoryModel;
    private $perPage = 5; // Set blogs per page

    public function __construct() {
        $db = require __DIR__ . '/../../config/database.php';
        $this->blogModel = new Blog($db);
        $this->blogCategoryModel = new BlogCategory($db);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $totalBlogs = $this->blogModel->getBlogCount();
        $totalPages = ceil($totalBlogs / $this->perPage);
        $offset = ($page - 1) * $this->perPage;

        $blogs = $this->blogModel->getPaginatedBlogs($this->perPage, $offset);
        
        require __DIR__ . '/../views/blogs/index.php';
    }

    /**
     * Fetch blogs for AJAX DataTables
     */
    public function fetchBlogs() {
        header('Content-Type: application/json');
    
        $draw = isset($_GET['draw']) ? (int)$_GET['draw'] : 1;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['length']) ? (int)$_GET['length'] : $this->perPage;
        $start = isset($_GET['start']) ? (int)$_GET['start'] : ($page - 1) * $limit;
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
    
        // Fetch total blogs
        $totalBlogs = $this->blogModel->getBlogCount($search);
        $filteredBlogs = $this->blogModel->getPaginatedBlogs($limit, $start, $search);
    
        echo json_encode([
            "draw" => $draw,
            "page" => $page, 
            "recordsTotal" => $totalBlogs,
            "recordsFiltered" => $totalBlogs, // should be total, not count of filtered records
            "data" => $filteredBlogs
        ]);
    }
    


    public function create() {
        $categories = $this->blogCategoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $cover = $_POST['cover'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $published_date = $_POST['published_date'];
            $cat_id = $_POST['cat_id'];

            if ($this->blogModel->createBlog($title, $cover, $description, $status, $published_date, $cat_id)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/blogs/create.php';
    }

    public function edit($id) {
        $blog = $this->blogModel->getBlogById($id);
        $categories = $this->blogCategoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $cover = $_POST['cover'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $published_date = $_POST['published_date'];
            $cat_id = $_POST['cat_id'];

            if ($this->blogModel->updateBlog($id, $title, $cover, $description, $status, $published_date, $cat_id)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/blogs/edit.php';
    }

    public function delete($id) {
        $this->blogModel->deleteBlog($id);
        header('Location: /UOBSAlumani/php-crud-app/public/blogs');
        exit;
    }
}
?>