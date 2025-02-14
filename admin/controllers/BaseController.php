<?php
namespace Admin\Controllers;

use App\Helpers\Config;

class BaseController {
    protected $db;
    protected $basePath;

    public function __construct() {
        $this->db = require __DIR__ . '/../../config/database.php';
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/');
    }

    /**
     * Load Admin Views dynamically
     * 
     * @param string $viewPath - The path of the view file (relative to /views/admin/)
     * @param array $data - Data to be passed to the view
     */
    protected function adminView($viewPath, $data = []) {
        extract($data); // Extract array into variables
        // var_dump( "/../views/admin/{$viewPath}.php");
        require __DIR__ . "/../views/{$viewPath}.php";
    }

    /**
     * Handle redirection
     */
    protected function redirect($path) {
        header('Location: ' . $this->basePath . $path);
        exit;
    }

    /**
     * Send JSON response (for AJAX requests)
     */
    protected function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Get pagination data for tables
     */
    protected function getPaginationData($totalRecords, $searchQuery = '') {
        $draw = isset($_GET['draw']) ? (int)$_GET['draw'] : 1;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
        $start = isset($_GET['start']) ? (int)$_GET['start'] : ($page - 1) * $limit;

        return [
            'draw' => $draw,
            'page' => $page,
            'limit' => $limit,
            'start' => $start,
            'search' => $searchQuery,
            'recordsTotal' => $totalRecords
        ];
    }

    /**
     * Handle File Upload
     */
    protected function handleFileUpload($file, $uploadDir = '/../../uploads/') {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . $uploadDir;
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
