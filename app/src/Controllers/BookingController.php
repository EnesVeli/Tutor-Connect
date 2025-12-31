<?php

namespace App\Controllers;

use App\Repositories\BookingRepository;
use App\Repositories\TutorRepository;

class BookingController
{
    public function create()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'student') {
            header('Location: /login');
            exit;
        }

        $tutorId = $_GET['tutor_id'] ?? null;
        if (!$tutorId) {
            die("Tutor ID is required.");
        }

        $tutorRepo = new TutorRepository();
        $tutorProfile = $tutorRepo->findByUserId((int)$tutorId);

        if (!$tutorProfile) {
            die("Tutor not found.");
        }

        $userRepo = new \App\Repositories\UserRepository();
        $tutorUser = $userRepo->findById((int)$tutorId);
        $tutorName = $tutorUser ? ($tutorUser->first_name . ' ' . $tutorUser->last_name) : "Unknown Tutor";

        require __DIR__ . '/../Views/Student/Book.php';
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tutorId = $_POST['tutor_id'];
            $comment = $_POST['student_comment'];
            $datePart = $_POST['date']; 
            $timePart = $_POST['time'];
            $scheduledAt = $datePart . ' ' . $timePart . ':00'; 
            $date = date('l, F j, Y \a\t H:i', strtotime($scheduledAt));
            $tutorRepo = new TutorRepository();
            $tutor = $tutorRepo->findByUserId((int)$tutorId);
            $tutorRate = $tutor->hourly_rate;

            $userRepo = new \App\Repositories\UserRepository(); 
            $tutorUser = $userRepo->findById((int)$tutorId);
            $tutorName = $tutorUser ? ($tutorUser->first_name . ' ' . $tutorUser->last_name) : "Unknown Tutor";
            
            require __DIR__ . '/../Views/Student/Payment.php';
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = $_SESSION['user_id'];
            $tutorId = $_POST['tutor_id'];
            $scheduledAt = $_POST['scheduled_at'];
            $comment = $_POST['student_comment'];

            $bookingRepo = new BookingRepository();
            $success = $bookingRepo->create($studentId, $tutorId, $scheduledAt, $comment);

            if ($success) {
                require __DIR__ . '/../Views/Bookings/Success.php';
            } else {
                echo "Error saving booking.";
            }
        }
    }
    
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $bookingRepo = new BookingRepository();
        $bookings = $bookingRepo->findByUserId($_SESSION['user_id'], $_SESSION['user_role']);

        require __DIR__ . '/../Views/Bookings/List.php';
    }

    public function update()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tutor') {
            die("Unauthorized");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingId = $_POST['booking_id'];
            $status = $_POST['status']; 

            $bookingRepo = new BookingRepository();
            $bookingRepo->updateStatus($bookingId, $status);

            header('Location: /bookings');
            exit;
        }
    }
}