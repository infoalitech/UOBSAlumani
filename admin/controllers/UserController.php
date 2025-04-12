<?php
namespace Admin\Controllers;

use Admin\Models\User;
use Admin\Models\Permission;

class UserController extends BaseController {
    private $userModel;
    private $permissionModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User($this->db);
        $this->permissionModel = new Permission($this->db);
    }

    /**
     * Display all users
     */
    public function index() {
        $users = $this->userModel->getAllUsers();
        $this->adminView('users/index', ['users' => $users]);
    }

    /**
     * Fetch users for AJAX DataTables
     */
    public function fetchUsers() {
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
                $this->redirect('/admin/users');
            }
        }

        $permissions = $this->permissionModel->getAllPermissions();
        $this->adminView('users/create', compact('permissions'));
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
                $this->redirect('/admin/users');
            }
        }

        $permissions = $this->permissionModel->getAllPermissions();
        $userPermissions = array_column($user['permissions'], 'id');

        $this->adminView('users/edit', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Show user details
     */
    public function detail($id) {
        $user = $this->userModel->read($id);
        if (!$user) {
            die("User not found.");
        }

        $this->adminView('users/detail', ['user' => $user]);
    }

    /**
     * Delete a user
     */
    public function delete($id) {
        $this->userModel->delete($id);
        $this->redirect('/admin/users');
    }

    public function updateStatus($id, $status) {
        $validStatuses = ['active', 'inactive', 'pending'];
    
        if (!$id || !in_array($status, $validStatuses)) {
            $this->redirect('/admin/users', ['error' => 'Invalid request']);
        }
    
        if ($this->userModel->updateUserStatus($id, $status)) {
            $this->redirect('/admin/users', ['success' => 'User status updated']);
        } else {
            $this->redirect('/admin/users', ['error' => 'Failed to update status']);
        }
    }
    
}
?>
