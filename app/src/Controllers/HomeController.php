<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $name = $_SESSION['user_name'];
        $role = $_SESSION['user_role'];

        require __DIR__ . '/../Views/Dashboard.php';
    }
}