<?php
namespace Admin\Controllers;

use Admin\Models\JobType;

class JobTypeController {
    private $jobTypeModel;

    public function __construct() {
        $db = require __DIR__ . '/../../config/database.php';
        $this->jobTypeModel = new JobType($db);
    }

    public function index() {
        $types = $this->jobTypeModel->getAllTypes();
        require '../views/job_types/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];

            if ($this->jobTypeModel->createType($name)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_types/create.php';
    }

    public function edit($id) {
        $type = $this->jobTypeModel->getTypeById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];

            if ($this->jobTypeModel->updateType($id, $name)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_types/edit.php';
    }

    public function delete($id) {
        $this->jobTypeModel->deleteType($id);
        header('Location: index.php');
        exit;
    }
}
?>