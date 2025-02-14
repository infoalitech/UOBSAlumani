<?php
namespace Admin\Controllers;

use Admin\Models\JobType;

class JobTypeController extends BaseController {
    private $jobTypeModel;

    public function __construct() {
        parent::__construct();
        $this->jobTypeModel = new JobType($this->db);
    }

    /**
     * Display all job types
     */
    public function index() {
        $types = $this->jobTypeModel->getAllTypes();
        $this->adminView('job_types/index', ['types' => $types]);
    }

    /**
     * Fetch job types for AJAX DataTables
     */
    public function fetchJobTypes() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalTypes = $this->jobTypeModel->getTypeCount($search);
        $pagination = $this->getPaginationData($totalTypes, $search);
        $filteredTypes = $this->jobTypeModel->getPaginatedTypes($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalTypes,
            "recordsFiltered" => $totalTypes,
            "data" => $filteredTypes
        ]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($this->jobTypeModel->createType($name)) {
                $this->redirect('/admin/jobs/type');
            }
        }
        $this->adminView('job_types/create');
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $type = $this->jobTypeModel->getTypeById($id);

        if (!$type) {
            die("Job Type not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($this->jobTypeModel->updateType($id, $name)) {
                $this->redirect('/admin/jobs/type');
            }
        }
        $this->adminView('job_types/edit', ['type' => $type]);
    }

    /**
     * Show job type details
     */
    public function detail($id) {
        $type = $this->jobTypeModel->getTypeById($id);

        if (!$type) {
            die("Job Type not found.");
        }

        $this->adminView('job_types/detail', ['type' => $type]);
    }

    /**
     * Delete a job type
     */
    public function delete($id) {
        $this->jobTypeModel->deleteType($id);
        $this->redirect('/admin/jobs/type');
    }
}
?>
