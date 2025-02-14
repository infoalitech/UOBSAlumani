<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\BlogCategory;

class BlogController extends BaseController {
    private $blogModel;
    private $blogCategoryModel;
    private $perPage = 5;

    public function __construct() {
        parent::__construct();
        $this->blogModel = new Blog($this->db);
        $this->blogCategoryModel = new BlogCategory($this->db);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalBlogs = $this->blogModel->getBlogCount();
        $offset = ($page - 1) * $this->perPage;
        $blogs = $this->blogModel->getPaginatedBlogs($this->perPage, $offset);
        $this->adminView('blogs/index', ['blogs' => $blogs]);
    }

    public function fetchBlogs() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalBlogs = $this->blogModel->getBlogCount($search);
        $pagination = $this->getPaginationData($totalBlogs, $search);
        $filteredBlogs = $this->blogModel->getPaginatedBlogs($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalBlogs,
            "recordsFiltered" => $totalBlogs,
            "data" => $filteredBlogs
        ]);
    }

    public function create() {
        $categories = $this->blogCategoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $published_date = $_POST['published_date'];
            $cat_id = $_POST['cat_id'];

            $cover = isset($_FILES['cover']) ? $this->handleFileUpload($_FILES['cover']) : '';

            if ($this->blogModel->createBlog($title, $cover, $description, $status, $published_date, $cat_id)) {
                $this->redirect('/admin/blogs');
            }
        }
        $this->adminView('blogs/create', ['categories' => $categories]);
    }
    public function detail($id) {
        $blog = $this->blogModel->getBlogById($id);

        if (!$blog) {
            die("Blog not found.");
        }

        $this->adminView('blogs/detail', ['blog' => $blog]);
    }
    public function edit($id) {
        $blog = $this->blogModel->getBlogById($id);
        $categories = $this->blogCategoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $published_date = $_POST['published_date'];
            $cat_id = $_POST['cat_id'];
            $cover = isset($_FILES['cover']) ? $this->handleFileUpload($_FILES['cover']) : $blog['cover'];

            if ($this->blogModel->updateBlog($id, $title, $cover, $description, $status, $published_date, $cat_id)) {
                $this->redirect('/admin/blogs');
            }
        }
        $this->adminView('blogs/edit', ['blog' => $blog,'categories'=>$categories]);
    }

    public function delete($id) {
        $this->blogModel->deleteBlog($id);
        $this->redirect('/admin/blogs');
    }
}
?>
