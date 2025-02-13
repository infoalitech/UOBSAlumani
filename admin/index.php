<?php
session_start();

// Include database configuration
require_once '../config/database.php';

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not authenticated
    exit();
}

// Include the header layout
include 'views/layouts/header.php';

// Redirect to the dashboard or main admin page
header('Location: views/users/index.php');
exit();
?>