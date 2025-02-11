<?php

namespace App\Controllers;

use App\Models\User;

class HomeController
{
    public function index()
    {
        // Load the home view
        require_once '../src/views/home.php';
    }
}