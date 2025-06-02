<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}
// Include database configuration
require_once '../config/database.php';

// Check if the user is authenticated
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['active'])) {
    header('Location: login.php'); // Redirect to login if not authenticated
    exit();
}

// Include the header layout
include 'views/layouts/header.php';

// Redirect to the dashboard or main admin page
header('Location: views/users/index.php');
exit();
?>