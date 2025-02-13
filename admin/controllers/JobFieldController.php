<?php
namespace Admin\Controllers;

use Admin\Models\JobField;

class JobFieldController {
    private $jobFieldModel;

    public function __construct() {
        $this->jobFieldModel = new JobField();
    }

    public function index() {
        $fields = $this->jobFieldModel->getAllFields();
        require '../views/job_fields/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobFieldModel->createField($name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_fields/create.php';
    }

    public function edit($id) {
        $field = $this->jobFieldModel->getFieldById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $status = $_POST['status'];

            if ($this->jobFieldModel->updateField($id, $name, $status)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_fields/edit.php';
    }

    public function delete($id) {
        $this->jobFieldModel->deleteField($id);
        header('Location: index.php');
        exit;
    }
}
?>