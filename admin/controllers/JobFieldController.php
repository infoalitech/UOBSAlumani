<?php
namespace Admin\Controllers;

use Admin\Models\JobField;

class JobFieldController extends BaseController {
    private $jobFieldModel;

    public function __construct() {
        parent::__construct();
        $this->jobFieldModel = new JobField($this->db);
    }

    /**
     * List all job fields
     */
    public function index() {
        $fields = $this->jobFieldModel->getAllFields();
        $this->adminView('job_fields/index', ['fields' => $fields]);
    }

    /**
     * Fetch job fields for AJAX DataTables
     */
    public function fetchFields() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalFields = $this->jobFieldModel->getFieldCount($search);
        $pagination = $this->getPaginationData($totalFields, $search);
        $filteredFields = $this->jobFieldModel->getPaginatedFields($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalFields,
            "recordsFiltered" => $totalFields,
            "data" => $filteredFields
        ]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $status = $_POST['status'];

            if ($this->jobFieldModel->createField($name, $status)) {
                $this->redirect('/admin/job_fields');
            }
        }
        $this->adminView('job_fields/create');
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $field = $this->jobFieldModel->getFieldById($id);

        if (!$field) {
            die("Field not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $status = $_POST['status'];

            if ($this->jobFieldModel->updateField($id, $name, $status)) {
                $this->redirect('/admin/job_fields');
            }
        }
        $this->adminView('job_fields/edit', ['field' => $field]);
    }

    /**
     * Show job field details
     */
    public function detail($id) {
        $field = $this->jobFieldModel->getFieldById($id);

        if (!$field) {
            die("Field not found.");
        }

        $this->adminView('job_fields/detail', ['field' => $field]);
    }

    /**
     * Delete a job field
     */
    public function delete($id) {
        $this->jobFieldModel->deleteField($id);
        $this->redirect('/admin/job_fields');
    }
}
?>
