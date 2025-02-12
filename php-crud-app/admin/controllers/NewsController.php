<?php
namespace Admin\Controllers;

use Admin\Models\News;

class NewsController {
    private $newsModel;

    public function __construct() {
        $db = require '../config/database.php';
        $this->newsModel = new News($db);
    }

    public function index() {
        $news = $this->newsModel->getAllNews();
        require '../views/news/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $status = $_POST['status'];
            $date = $_POST['date'];
            $end_date = $_POST['end_date'];

            if ($this->newsModel->createNews($name, $desc, $status, $date, $end_date)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/news/create.php';
    }

    public function edit($id) {
        $news = $this->newsModel->getNewsById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $status = $_POST['status'];
            $date = $_POST['date'];
            $end_date = $_POST['end_date'];

            if ($this->newsModel->updateNews($id, $name, $desc, $status, $date, $end_date)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/news/edit.php';
    }

    public function delete($id) {
        $this->newsModel->deleteNews($id);
        header('Location: index.php');
        exit;
    }
}
?>