<?php
namespace Admin\Controllers;

use Admin\Models\User;

class UserController {
    private $userModel;

    public function __construct() {
        // $this->userModel = new User();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require '../views/users/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $active = $_POST['active'];

            if ($this->userModel->createUser($name, $email, $password, $active)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/users/create.php';
    }

    public function edit($id) {
        $user = $this->userModel->getUserById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $active = $_POST['active'];

            if ($this->userModel->updateUser($id, $name, $email, $active)) {
                header('Location: index.php');
                exit;
            }
        }
        require '../views/users/edit.php';
    }

    public function delete($id) {
        $this->userModel->deleteUser($id);
        header('Location: index.php');
        exit;
    }
}
?>