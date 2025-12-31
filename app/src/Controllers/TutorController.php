<?php

namespace App\Controllers;

use App\Repositories\TutorRepository;

class TutorController
{
    public function edit()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tutor') {
            header('Location: /login');
            exit;
        }

        $tutorRepo = new TutorRepository();
        $profile = $tutorRepo->findByUserId($_SESSION['user_id']);

        $message = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bio = $_POST['bio'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $hourlyRate = (float) ($_POST['hourly_rate'] ?? 0);
            $experience = (int) ($_POST['experience_years'] ?? 0);
            
            $start = $_POST['availability_start'] ?? '09:00';
            $end = $_POST['availability_end'] ?? '17:00';

            $success = $tutorRepo->save($_SESSION['user_id'], $bio, $hourlyRate, $experience, $subject, $start, $end);
            
            if ($success) {
                $message = "Profile saved successfully!";
                $profile = $tutorRepo->findByUserId($_SESSION['user_id']);
            } else {
                $message = "Error saving profile.";
            }
        }

        require __DIR__ . '/../Views/Tutor/Profile.php';
    }
}