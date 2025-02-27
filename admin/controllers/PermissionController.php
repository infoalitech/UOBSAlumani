<?php
namespace Admin\Controllers;

use Admin\Models\Permission;

class PermissionController extends BaseController {
    private $permissionModel;

    public function __construct() {
        parent::__construct();
        $this->permissionModel = new Permission($this->db);
        
    }

    public function index() {
        $users = $this->permissionModel->getAllPermissions();
        // require '../views/permission/index.php';
    }
}