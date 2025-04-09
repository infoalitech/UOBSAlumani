<?php
namespace Admin\Models;

use PDO;
use PDOException;

class AlumniProfile {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Create a new alumni profile
     */
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO alumni_profiles (
                    user_id, graduation_year, department, program, phone,
                    current_city, current_position, company_name,
                    linkedin_url, profile_picture
                ) VALUES (
                    :user_id, :graduation_year, :department, :program, :phone,
                    :current_city, :current_position, :company_name,
                    :linkedin_url, :profile_picture
                )
            ");
            $stmt->execute([
                'user_id' => (int)$data['user_id'],
                'graduation_year' => $data['graduation_year'],
                'department' => $data['department'],
                'program' => $data['program'],
                'phone' => $data['phone'],
                'current_city' => $data['current_city'],
                'current_position' => $data['current_position'],
                'company_name' => $data['company_name'],
                'linkedin_url' => $data['linkedin_url'],
                'profile_picture' => $data['profile_picture']
            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("AlumniProfile::create - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get profile by ID
     */
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM alumni_profiles WHERE id = :id");
            $stmt->execute(['id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("AlumniProfile::getById - " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get profile by user ID
     */
    public function getByUserId($userId) {
        try {
            // print("SELECT * FROM alumni_profiles WHERE user_id = $userId");
            $stmt = $this->db->prepare("SELECT * FROM alumni_profiles WHERE user_id = :user_id");
            $stmt->execute(['user_id' => (int)$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("AlumniProfile::getByUserId - " . $e->getMessage());
            return null;
        }
    }

    /**
     * Update alumni profile
     */
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE alumni_profiles SET
                    graduation_year = :graduation_year,
                    department = :department,
                    program = :program,
                    phone = :phone,
                    current_city = :current_city,
                    current_position = :current_position,
                    company_name = :company_name,
                    linkedin_url = :linkedin_url,
                    profile_picture = :profile_picture
                WHERE id = :id
            ");
            $stmt->execute([
                'id' => (int)$id,
                'graduation_year' => $data['graduation_year'],
                'department' => $data['department'],
                'program' => $data['program'],
                'phone' => $data['phone'],
                'current_city' => $data['current_city'],
                'current_position' => $data['current_position'],
                'company_name' => $data['company_name'],
                'linkedin_url' => $data['linkedin_url'],
                'profile_picture' => $data['profile_picture']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("AlumniProfile::update - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete alumni profile
     */
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM alumni_profiles WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("AlumniProfile::delete - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all alumni profiles (optional: add pagination, filters)
     */
    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM alumni_profiles ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("AlumniProfile::getAll - " . $e->getMessage());
            return [];
        }
    }
}
