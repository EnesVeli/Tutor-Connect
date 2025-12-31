<?php

namespace App\Repositories;

use App\Framework\Repository;
use App\Models\TutorProfile;
use PDO;

class TutorRepository extends Repository
{
    public function findByUserId(int $userId): ?TutorProfile
    {
        $stmt = $this->db->prepare("SELECT * FROM tutor_profiles WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, TutorProfile::class);
        $profile = $stmt->fetch();
        return $profile ?: null;
    }

    public function save(int $userId, string $bio, float $hourlyRate, int $experience, string $subject, string $start, string $end): bool
    {
        $existing = $this->findByUserId($userId);

        if ($existing) {
            $stmt = $this->db->prepare("
                UPDATE tutor_profiles 
                SET bio = :bio, hourly_rate = :rate, experience_years = :exp, subject = :subj, availability_start = :start, availability_end = :end
                WHERE user_id = :uid
            ");
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO tutor_profiles (user_id, bio, hourly_rate, experience_years, subject, availability_start, availability_end) 
                VALUES (:uid, :bio, :rate, :exp, :subj, :start, :end)
            ");
        }

        return $stmt->execute([
            'uid' => $userId,
            'bio' => $bio,
            'rate' => $hourlyRate,
            'exp' => $experience,
            'subj' => $subject,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function getAllTutors(): array
    {
        $sql = "SELECT t.*, u.first_name, u.last_name, u.email FROM tutor_profiles t JOIN users u ON t.user_id = u.id";
        return $this->db->query($sql)->fetchAll();
    }

    public function searchTutors(?string $subject, ?float $maxPrice): array
    {
        $sql = "SELECT t.*, u.first_name, u.last_name, u.email 
                FROM tutor_profiles t 
                JOIN users u ON t.user_id = u.id 
                WHERE 1=1";
        
        $params = [];
        if (!empty($subject)) {
            $sql .= " AND t.subject LIKE :subject";
            $params['subject'] = "%$subject%";
        }
        if (!empty($maxPrice)) {
            $sql .= " AND t.hourly_rate <= :max_price";
            $params['max_price'] = $maxPrice;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}