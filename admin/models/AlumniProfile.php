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
        // try {
        print_r($data);
            $stmt = $this->db->prepare("
                INSERT INTO alumni_profiles (
                    user_id, full_name, reg_no, father_name, cnic, email
                ) VALUES (
                    :user_id, :full_name, :reg_no, :father_name, :cnic, :email
                )
            ");
            
            $stmt->execute([
                'user_id' => (int)$data['user_id'],
                'full_name' => $data['full_name'] ?? '', // ✅ Add this
                'reg_no' => $data['reg_no'] ?? '',
                'father_name' => $data['father_name'] ?? '',
                'cnic' => $data['cnic'] ?? '',
                'email' => $data['email'] ?? ''
            ]);
    
            return $this->db->lastInsertId();
        // } catch (PDOException $e) {
        //     error_log("AlumniProfile::create - " . $e->getMessage());
        //     return false;
        // }
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
                    education_level_id = :education_level_id,
                    additional_qualifications = :additional_qualifications,
                    current_city = :current_city,
                    current_position = :current_position,
                    company_name = :company_name,
                    job_type = :job_type,
                    experience_years = :experience_years,
                    email = :email,
                    phone = :phone,
                    linkedin_url = :linkedin_url,
                    portfolio_url = :portfolio_url,
                    profile_picture = :profile_picture,
                    is_profile_public = :is_profile_public,
                    show_contact_info = :show_contact_info,
                    show_position = :show_position
                WHERE id = :id
            ");
            $stmt->execute([
                'id' => (int)$id,
                'graduation_year' => $data['graduation_year'],
                'department' => $data['department'],
                'program' => $data['program'],
                'education_level_id' => $data['education_level_id'],
                'additional_qualifications' => $data['additional_qualifications'],
                'current_city' => $data['current_city'],
                'current_position' => $data['current_position'],
                'company_name' => $data['company_name'],
                'job_type' => $data['job_type'],
                'experience_years' => $data['experience_years'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'linkedin_url' => $data['linkedin_url'],
                'portfolio_url' => $data['portfolio_url'],
                'profile_picture' => $data['profile_picture'],
                'is_profile_public' => (int)$data['is_profile_public'],
                'show_contact_info' => (int)$data['show_contact_info'],
                'show_position' => (int)$data['show_position']
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
     * Get all alumni profiles
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
