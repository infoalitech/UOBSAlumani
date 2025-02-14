<?php
namespace Admin\Controllers;

use Admin\Models\User;

class PermissionController {
    private $userModel;

    public function __construct() {
        // $this->userModel = new User();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require '../views/users/index.php';
    }

}