<?php
namespace Admin\Controllers;

use Admin\Models\News;

class NewsController extends BaseController {
    private $newsModel;

    public function __construct() {
        parent::__construct();
        $this->newsModel = new News($this->db);
    }

    /**
     * Display all news articles
     */
    public function index() {
        $news = $this->newsModel->getAllNews();
        $this->adminView('news/index', ['news' => $news]);
    }

    /**
     * Fetch news articles for AJAX DataTables
     */
    public function fetchNews() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalNews = $this->newsModel->getNewsCount($search);
        $pagination = $this->getPaginationData($totalNews, $search);
        $filteredNews = $this->newsModel->getPaginatedNews($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalNews,
            "recordsFiltered" => $totalNews,
            "data" => $filteredNews
        ]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $desc = trim($_POST['desc']);
            $status = $_POST['status'];
            $date = $_POST['date'];
            $end_date = $_POST['end_date'];
            print_r($this->newsModel->createNews($name, $desc, $status, $date, $end_date));  
            if ($this->newsModel->createNews($name, $desc, $status, $date, $end_date)) {
                $this->redirect('/admin/news');
            }
        }
        $this->adminView('news/create');
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            die("News article not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $desc = trim($_POST['desc']);
            $status = $_POST['status'];
            $date = $_POST['date'];
            $end_date = $_POST['end_date'];

            if ($this->newsModel->updateNews($id, $name, $desc, $status, $date, $end_date)) {
                $this->redirect('/admin/news');
            }
        }
        $this->adminView('news/edit', ['news' => $news]);
    }

    /**
     * Show news details
     */
    public function detail($id) {
        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            die("News article not found.");
        }

        $this->adminView('news/detail', ['news' => $news]);
    }

    /**
     * Delete a news article
     */
    public function delete($id) {
        $this->newsModel->deleteNews($id);
        $this->redirect('/admin/news');
    }
}
?>
