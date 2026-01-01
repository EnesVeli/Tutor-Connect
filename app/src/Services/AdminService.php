<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\BookingRepository;

class AdminService
{
    private UserRepository $userRepo;
    private BookingRepository $bookingRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->bookingRepo = new BookingRepository();
    }

    public function getAllUsers(): array
    {
        return $this->userRepo->findAllWithBio();
    }

    public function getUser(int $id)
    {
        return $this->userRepo->findById($id);
    }

    public function updateUser(int $id, string $fname, string $lname, string $email): bool
    {
        return $this->userRepo->update($id, $fname, $lname, $email);
    }

    public function deleteUser(int $userId): bool
    {
        if ($userId == $_SESSION['user_id']) return false;
        return $this->userRepo->delete($userId);
    }

    public function getDashboardStats(): array
    {
        $userStats = $this->userRepo->getStatistics();
        $bookingStats = $this->bookingRepo->getStatistics();

        return array_merge($userStats, $bookingStats);
    }
}