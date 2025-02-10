<?php
/* middleware/auth.php */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function requireAuth() {
    if (!isAuthenticated()) {
        header("Location: login.php");
        exit();
    }
}

function loginUser($userId, $permissions) {
    $_SESSION['user_id'] = $userId;
    $_SESSION['permissions'] = $permissions;
    session_regenerate_id(true);
}

function logoutUser() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
