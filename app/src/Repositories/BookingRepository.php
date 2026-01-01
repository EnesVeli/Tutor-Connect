<?php

namespace App\Repositories;

use App\Framework\Repository;
use App\Models\Booking;
use PDO;

class BookingRepository extends Repository
{
    public function create(int $studentId, int $tutorId, string $scheduledAt, string $comment): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO bookings (student_id, tutor_id, scheduled_at, student_comment, status) 
            VALUES (:sid, :tid, :date, :comment, 'pending')
        ");

        return $stmt->execute([
            'sid' => $studentId,
            'tid' => $tutorId,
            'date' => $scheduledAt,
            'comment' => $comment
        ]);
    }

    public function findByUserId(int $userId, string $role): array
    {
        $column = ($role === 'student') ? 'student_id' : 'tutor_id';
        
        if ($role === 'student') {
            $sql = "SELECT b.*, u.first_name, u.last_name, u.email 
                    FROM bookings b
                    JOIN users u ON u.id = b.tutor_id
                    WHERE b.student_id = :uid
                    ORDER BY b.scheduled_at DESC";
        } else {
            $sql = "SELECT b.*, u.first_name, u.last_name, u.email, sp.date_of_birth
                    FROM bookings b
                    JOIN users u ON u.id = b.student_id
                    LEFT JOIN student_profiles sp ON sp.user_id = u.id
                    WHERE b.tutor_id = :uid
                    ORDER BY b.scheduled_at DESC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }
    public function updateStatus(int $bookingId, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $bookingId]);
    }

    public function getStatistics(): array
    {
        $totalBookings = $this->db->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
        
        $earningsSql = "
            SELECT SUM(t.hourly_rate) 
            FROM bookings b 
            JOIN tutor_profiles t ON b.tutor_id = t.user_id 
            WHERE b.status = 'confirmed'
        ";
        $totalEarnings = $this->db->query($earningsSql)->fetchColumn();

        return [
            'total_bookings' => $totalBookings,
            'total_earnings' => $totalEarnings ?: 0
        ];
    }
}