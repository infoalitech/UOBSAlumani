<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function hasPermission($permission) {
    return isset($_SESSION['permissions']) && in_array($permission, $_SESSION['permissions']);
}

function requirePermission($permission) {
    if (!hasPermission($permission)) {
        die("Unauthorized Access - You do not have permission to view this page.");
    }
}