<?php
namespace Admin\Models;

use PDO;

class Job {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllJobs() {
        $stmt = $this->db->query("SELECT * FROM jobs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJobById($id) {
        $stmt = $this->db->prepare("SELECT * FROM jobs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createJob($name, $status) {
        $stmt = $this->db->prepare("INSERT INTO jobs (name, status) VALUES (:name, :status)");
        return $stmt->execute(compact('name', 'status'));
    }

    public function updateJob($id, $name, $status) {
        $stmt = $this->db->prepare("UPDATE jobs SET name = :name, status = :status WHERE id = :id");
        return $stmt->execute(compact('id', 'name', 'status'));
    }

    public function deleteJob($id) {
        $stmt = $this->db->prepare("DELETE FROM jobs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>