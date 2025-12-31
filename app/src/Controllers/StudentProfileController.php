<?php

namespace App\Controllers;

use App\Repositories\StudentRepository;

class StudentProfileController
{
    public function edit()
    {
        //  check
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'student') {
            header('Location: /login');
            exit;
        }

        $repo = new StudentRepository();
        $profile = $repo->findByUserId($_SESSION['user_id']);
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dob = $_POST['date_of_birth'];
            if ($repo->save($_SESSION['user_id'], $dob)) {
                $message = "Profile saved!";
                $profile = $repo->findByUserId($_SESSION['user_id']); 
            }
        }

        require __DIR__ . '/../Views/Student/Profile.php';
    }
}