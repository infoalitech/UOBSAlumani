<?php
namespace Admin\Controllers;

use Admin\Models\JobEducationLevel;

class JobEducationLevelController {
    private $jobEducationLevelModel;

    public function __construct() {
        $this->jobEducationLevelModel = new JobEducationLevel();
    }

    public function index() {
        $levels = $this->jobEducationLevelModel->getAllLevels();
        require '../views/job_education_levels/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $level = $_POST['level'];

            if ($this->jobEducationLevelModel->createLevel($level)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_education_levels/create.php';
    }

    public function edit($id) {
        $level = $this->jobEducationLevelModel->getLevelById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $level = $_POST['level'];

            if ($this->jobEducationLevelModel->updateLevel($id, $level)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/job_education_levels/edit.php';
    }

    public function delete($id) {
        $this->jobEducationLevelModel->deleteLevel($id);
        header('Location: index.php');
        exit;
    }
}
?>