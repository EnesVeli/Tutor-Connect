<?php

namespace App\Controllers;

use App\Repositories\TutorRepository;

class StudentController
{
public function index()
    {
        $tutorRepo = new TutorRepository();
        
        $subject = $_GET['subject'] ?? null;
        $price = !empty($_GET['price']) ? (float)$_GET['price'] : null;
        $tutors = $tutorRepo->searchTutors($subject, $price);

        require __DIR__ . '/../Views/Student/TutorList.php';
    }
}