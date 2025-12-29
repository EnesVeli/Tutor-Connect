<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // 1. Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // 2. Prepare data for the view
        $name = $_SESSION['user_name'];
        $role = $_SESSION['user_role'];

        // 3. Load the Dashboard View
        require __DIR__ . '/../Views/Dashboard.php';
    }
}