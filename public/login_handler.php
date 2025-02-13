<?php
require_once '../vendor/autoload.php';

use Admin\Controllers\AuthController;

$authController = new AuthController();
$authController->login();
?>