<?php
namespace Admin\Controllers;

use Admin\Models\Job;

class JobsController {
    private $jobModel;

    public function __construct() {
        $db = require '../config/database.php';
        $this->jobModel = new Job($db);
    }

    public function index() {
        $jobs = $this->jobModel->getAllJobs();
        require '../views/jobs/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobModel->createJob($name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/jobs/create.php';
    }

    public function edit($id) {
        $job = $this->jobModel->getJobById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobModel->updateJob($id, $name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/jobs/edit.php';
    }

    public function delete($id) {
        $this->jobModel->deleteJob($id);
        header('Location: index.php');
        exit;
    }
}
?>