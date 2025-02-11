<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function register($data)
    {
        $user = new User();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        return $user->save();
    }

    public function login($data)
    {
        $user = User::findByEmail($data['email']);
        if ($user && password_verify($data['password'], $user->password)) {
            $_SESSION['user_id'] = $user->id;
            return true;
        }
        return false;
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }
}