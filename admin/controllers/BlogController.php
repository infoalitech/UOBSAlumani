<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\BlogCategory;
use App\Helpers\Config; // Import the Config class

class BlogController {
    private $blogModel;
    private $blogCategoryModel;
    private $perPage = 5; // Set blogs per page
    private $basePath = 5; // Set blogs per page

    public  function __construct() {
        $db = require __DIR__ . '/../../config/database.php';
        $this->blogModel = new Blog($db);
        $this->blogCategoryModel = new BlogCategory($db);

        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
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
            // $cover = $_POST['cover'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $published_date = $_POST['published_date'];
            $cat_id = $_POST['cat_id'];

            if(isset($_FILES['cover'])) {
                $cover = $this->handleFileUpload($_FILES['cover']);
            }else {
                $cover = '';
            }

            if ($this->blogModel->createBlog($title, $cover, $description, $status, $published_date, $cat_id)) {
                header('Location: '. $this->basePath.'/admin/blogs');
                exit;
            }
        }
        require __DIR__ . '/../views/blogs/create.php';
    }
    public function detail($id) {
        $blog = $this->blogModel->getBlogById($id);
        require __DIR__ . '/../views/blogs/detail.php';
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
            if(isset($_FILES['cover'])) {
                $cover = $this->handleFileUpload($_FILES['cover']);
            }else {
                $cover = '';
            }
            if ($this->blogModel->updateBlog($id, $title, $cover, $description, $status, $published_date, $cat_id)) {
                header('Location: '. $this->basePath.'/admin/blogs');
                exit;
            }
        }
        require __DIR__ . '/../views/blogs/edit.php';
    }

    public function delete($id) {
        $this->blogModel->deleteBlog($id);
        header('Location: '. $this->basePath.'/admin/blogs');
        exit;
    }

    /**
     * Handle File Upload
     */
    private function handleFileUpload($file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/';
            $fileName = time() . '_' . basename($file['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return 'uploads/' . $fileName; // Save relative path to database
            }
        }
        return ''; // Return empty string if upload fails
    }
}
?>