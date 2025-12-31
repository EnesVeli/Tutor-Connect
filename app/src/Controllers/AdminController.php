<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class AdminController
{
    public function users()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $userRepo = new UserRepository();
        $users = $userRepo->findAll();

        require __DIR__ . '/../Views/Dashboard.php';
    }
}