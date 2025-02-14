<?php
namespace Admin\Controllers;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Replace with your own logic to validate the username and password
            if ($username == 'admin' && $password == 'password') {
                session_start();
                $_SESSION['username'] = $username;
                header('Location: index');
                exit;
            } else {
                echo 'Invalid username or password';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: login');
        exit;
    }
}
?>