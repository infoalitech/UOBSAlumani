<?php
namespace Admin\Models;

use PDO;

class JobType {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllTypes() {
        $stmt = $this->db->query("SELECT * FROM job_types");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypeById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_types WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createType($name) {
        $stmt = $this->db->prepare("INSERT INTO job_types (name) VALUES (:name)");
        return $stmt->execute(compact('name'));
    }

    public function updateType($id, $name) {
        $stmt = $this->db->prepare("UPDATE job_types SET name = :name WHERE id = :id");
        return $stmt->execute(compact('id', 'name'));
    }

    public function deleteType($id) {
        $stmt = $this->db->prepare("DELETE FROM job_types WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>