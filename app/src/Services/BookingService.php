<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Repositories\TutorRepository;
use App\Repositories\UserRepository;
use App\Repositories\StudentRepository;

class BookingService
{
    private BookingRepository $bookingRepo;
    private TutorRepository $tutorRepo;
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->bookingRepo = new BookingRepository();
        $this->tutorRepo = new TutorRepository();
        $this->userRepo = new UserRepository();
    }

    public function getBookingFormDetails(int $tutorId): array
    {
        $tutorProfile = $this->tutorRepo->findByUserId($tutorId);
        $tutorUser = $this->userRepo->findById($tutorId);

        return [
            'tutorProfile' => $tutorProfile,
            'tutorName' => $tutorUser ? ($tutorUser->first_name . ' ' . $tutorUser->last_name) : "Unknown Tutor"
        ];
    }

    public function preparePayment(int $tutorId, string $date, string $time): array
    {
        $scheduledAt = $date . ' ' . $time . ':00';
        
        $tutorProfile = $this->tutorRepo->findByUserId($tutorId);
        $tutorUser = $this->userRepo->findById($tutorId);
        
        return [
            'scheduledAt' => $scheduledAt,
            'prettyDate' => date('l, F j, Y \a\t H:i', strtotime($scheduledAt)),
            'tutorName' => $tutorUser ? ($tutorUser->first_name . ' ' . $tutorUser->last_name) : "Unknown",
            'rate' => $tutorProfile->hourly_rate ?? 0
        ];
    }

    public function createBooking(int $studentId, int $tutorId, string $scheduledAt, string $comment): bool
    {
        return $this->bookingRepo->create($studentId, $tutorId, $scheduledAt, $comment);
    }

    public function getUserBookings(int $userId, string $role): array
    {
        return $this->bookingRepo->findByUserId($userId, $role);
    }

    public function updateBookingStatus(int $bookingId, string $status): bool
    {
        return $this->bookingRepo->updateStatus($bookingId, $status);
    }
}