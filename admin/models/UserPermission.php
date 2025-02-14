<?php
namespace Admin\Models;

use PDO;

class UserPermission {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM job_categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name, $status) {
        $stmt = $this->db->prepare("INSERT INTO job_categories (name, status) VALUES (:name, :status)");
        return $stmt->execute(compact('name', 'status'));
    }

    public function updateCategory($id, $name, $status) {
        $stmt = $this->db->prepare("UPDATE job_categories SET name = :name, status = :status WHERE id = :id");
        return $stmt->execute(compact('id', 'name', 'status'));
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM job_categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>