<?php
namespace Admin\Controllers;

use Admin\Models\Blog;
use Admin\Models\BlogCategory;

class BlogController {
    private $blogModel;
    private $blogCategoryModel;

    public function __construct() {
        $db = require '../config/database.php';
        $this->blogModel = new Blog($db);
        $this->blogCategoryModel = new BlogCategory($db);
    }

    public function index() {
        $blogs = $this->blogModel->getAllBlogs();
        require '../views/blogs/index.php';
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
        header('Location: index.php');
        exit;
    }
}
?>