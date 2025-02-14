<?php
namespace Admin\Controllers;

use Admin\Models\JobEducationLevel;

class JobEducationLevelController extends BaseController {
    private $jobEducationLevelModel;

    public function __construct() {
        parent::__construct();
        $this->jobEducationLevelModel = new JobEducationLevel($this->db);
    }

    /**
     * List all job education levels
     */
    public function index() {
        $educationLevels = $this->jobEducationLevelModel->getAllLevels();
        $this->adminView('job_education_levels/index', ['educationLevels' => $educationLevels]);
    }

    /**
     * Fetch job education levels for AJAX DataTables
     */
    public function fetchEducationLevels() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalEducationLevels = $this->jobEducationLevelModel->getLevelCount($search);
        $pagination = $this->getPaginationData($totalEducationLevels, $search);
        $filteredEducationLevels = $this->jobEducationLevelModel->getPaginatedLevels($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalEducationLevels,
            "recordsFiltered" => $totalEducationLevels,
            "data" => $filteredEducationLevels
        ]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $level = trim($_POST['level']);

            if (empty($level)) {
                $error = "Invalid input. Please check your data.";
            } else {
                if ($this->jobEducationLevelModel->createLevel($level)) {
                    print($level);  
                    $this->redirect('/admin/jobs/education');
                }
            }
        }
        $this->adminView('job_education_levels/create');
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $educationLevel = $this->jobEducationLevelModel->getLevelById($id);

        if (!$educationLevel) {
            die("Education Level not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $level = trim($_POST['level']);

            if (empty($level)) {
                $error = "Invalid input. Please check your data.";
            } else {
                if ($this->jobEducationLevelModel->updateLevel($id, $level)) {
                    $this->redirect('/admin/jobs/education');
                }
            }
        }
        $this->adminView('job_education_levels/edit', ['educationLevel' => $educationLevel]);
    }

    /**
     * Show details of a specific education level
     */
    public function detail($id) {
        $educationLevel = $this->jobEducationLevelModel->getLevelById($id);

        if (!$educationLevel) {
            die("Education Level not found.");
        }

        $this->adminView('job_education_levels/detail', ['educationLevel' => $educationLevel]);
    }

    /**
     * Delete a job education level
     */
    public function delete($id) {
        $this->jobEducationLevelModel->deleteLevel($id);
        $this->redirect('/admin/jobs/education');
    }
}
?>
