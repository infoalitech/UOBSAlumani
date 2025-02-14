<?php
namespace Admin\Controllers;

use Admin\Models\UserPermission;

class UserPermissionController {
    private $userPermissionModel;

    public function __construct() {
        $db = require __DIR__ . '/../../config/database.php';
        $this->userPermissionModel = new UserPermission($db);
    }
    public function index() {
        $permissions = $this->userPermissionModel->getAllPermissions();
        require '../views/permissions/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $slug = $_POST['slug'];

            if ($this->userPermissionModel->createPermission($name, $slug)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/permissions/create.php';
    }

    public function edit($id) {
        $permission = $this->userPermissionModel->getPermissionById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $slug = $_POST['slug'];

            if ($this->userPermissionModel->updatePermission($id, $name, $slug)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/permissions/edit.php';
    }

    public function delete($id) {
        $this->userPermissionModel->deletePermission($id);
        header('Location: index.php');
        exit;
    }
}
?>