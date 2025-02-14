<?php
namespace Admin\Models;

use PDO;

class JobEducationLevel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllLevels() {
        $stmt = $this->db->query("SELECT * FROM job_education_levels");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLevelById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_education_levels WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createLevel($level) {
        $stmt = $this->db->prepare("INSERT INTO job_education_levels (level) VALUES (:level)");
        return $stmt->execute(compact('level'));
    }

    public function updateLevel($id, $level) {
        $stmt = $this->db->prepare("UPDATE job_education_levels SET level = :level WHERE id = :id");
        return $stmt->execute(compact('id', 'level'));
    }

    public function deleteLevel($id) {
        $stmt = $this->db->prepare("DELETE FROM job_education_levels WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>