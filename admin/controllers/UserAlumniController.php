<?php
namespace Admin\Controllers;

use Admin\Models\UserAlumni;
use Admin\Models\Permission;
use Admin\Models\AlumniProfile;

class UserAlumniController extends BaseController {
    private $userModel;
    private $permissionModel;

        private $profileModel;
    public function __construct() {
        parent::__construct();
        $this->userModel = new UserAlumni($this->db);
        $this->permissionModel = new Permission($this->db);
        $this->profileModel = new AlumniProfile($this->db);
    }

    /**
     * Display all users
     */
    public function index() {
        $users = $this->userModel->getAllUsers();
        $this->adminView('alumni/index', ['users' => $users]);
    }

    /**
     * Fetch users for AJAX DataTables
     */
    public function fetchalumni() {
        $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
        $totalUsers = $this->userModel->getUserCount($search);
        $pagination = $this->getPaginationData($totalUsers, $search);
        $filteredUsers = $this->userModel->getPaginatedUsers($pagination['limit'], $pagination['start'], $search);

        $this->jsonResponse([
            "draw" => $pagination['draw'],
            "page" => $pagination['page'],
            "recordsTotal" => $totalUsers,
            "recordsFiltered" => $totalUsers,
            "data" => $filteredUsers
        ]);
    }

    /**
     * Show create form and handle submission
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];
            $active = $_POST['active'];
            $permissions = $_POST['permission_ids'] ?? [];
            $isAlumni = isset($_POST['is_alumni']) ? 1 : 0;

            if ($this->userModel->create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'active' => $active,
                'permissions' => $permissions,
                'is_alumni' => $isAlumni
            ])) {
                $this->redirect('/admin/alumni');
            }
        }

        $permissions = $this->permissionModel->getAllPermissions();
        $this->adminView('alumni/create', compact('permissions'));
    }

    /**
     * Show edit form and handle update
     */
    public function edit($id) {
        $user = $this->userModel->read($id);
        if (!$user) {
            die("User not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $active = $_POST['active'];
            $permissions = $_POST['permission_ids'] ?? [];
            $isAlumni = isset($_POST['is_alumni']) ? 1 : 0;

            if ($this->userModel->update($id, [
                'name' => $name,
                'email' => $email,
                'permissions' => $permissions,
                'active' => $active,
                'is_alumni' => $isAlumni
            ])) {
                $this->redirect('/admin/alumni');
            }
        }

        $permissions = $this->permissionModel->getAllPermissions();
        $userPermissions = array_column($user['permissions'], 'id');

        $this->adminView('alumni/edit', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Show user details
     */
    public function detail($id) {
        $user = $this->userModel->read($id);
        $user = $this->userModel->read($id);
        if (!$user) {
            die("User not found.");
        }
        $profile = $this->profileModel->getByUserId($user['id']);

        if (!$profile) {
            die("Profile not found.");
        }
        $this->adminView('alumni/detail', ['user' => $user, 'profile' =>$profile]);
    }

    /**
     * Delete a user
     */
    public function delete($id) {
        $this->userModel->delete($id);
        $this->redirect('/admin/alumni');
    }

    public function updateStatus($id, $status) {
        $validStatuses = ['active', 'inactive', 'pending'];
    
        if (!$id || !in_array($status, $validStatuses)) {
            $this->redirect('/admin/alumni', ['error' => 'Invalid request']);
        }
    
        if ($this->userModel->updateUserStatus($id, $status)) {
            $this->redirect('/admin/alumni', ['success' => 'User status updated']);
        } else {
            $this->redirect('/admin/alumni', ['error' => 'Failed to update status']);
        }
    }
    
}
?>
