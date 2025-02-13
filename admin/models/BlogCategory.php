<?php
namespace Admin\Models;

use PDO;

class BlogCategory {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM blog_categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM blog_categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name) {
        $stmt = $this->db->prepare("INSERT INTO blog_categories (name) VALUES (:name)");
        return $stmt->execute(compact('name'));
    }

    public function updateCategory($id, $name) {
        $stmt = $this->db->prepare("UPDATE blog_categories SET name = :name WHERE id = :id");
        return $stmt->execute(compact('id', 'name'));
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM blog_categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>