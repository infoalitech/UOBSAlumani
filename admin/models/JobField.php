<?php
namespace Admin\Models;

use PDO;

class JobField {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllFields() {
        $stmt = $this->db->query("SELECT * FROM job_fields");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFieldById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_fields WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createField($name, $status) {
        $stmt = $this->db->prepare("INSERT INTO job_fields (name, status) VALUES (:name, :status)");
        return $stmt->execute(compact('name', 'status'));
    }

    public function updateField($id, $name, $status) {
        $stmt = $this->db->prepare("UPDATE job_fields SET name = :name, status = :status WHERE id = :id");
        return $stmt->execute(compact('id', 'name', 'status'));
    }

    public function deleteField($id) {
        $stmt = $this->db->prepare("DELETE FROM job_fields WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>