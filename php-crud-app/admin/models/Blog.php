<?php
namespace Admin\Models;

use PDO;

class Blog {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllBlogs() {
        $stmt = $this->db->query("SELECT * FROM blogs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBlogById($id) {
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createBlog($title, $cover, $description, $status, $published_date, $cat_id) {
        $stmt = $this->db->prepare("INSERT INTO blogs (title, cover, description, status, published_date, cat_id) VALUES (:title, :cover, :description, :status, :published_date, :cat_id)");
        return $stmt->execute(compact('title', 'cover', 'description', 'status', 'published_date', 'cat_id'));
    }

    public function updateBlog($id, $title, $cover, $description, $status, $published_date, $cat_id) {
        $stmt = $this->db->prepare("UPDATE blogs SET title = :title, cover = :cover, description = :description, status = :status, published_date = :published_date, cat_id = :cat_id WHERE id = :id");
        return $stmt->execute(compact('id', 'title', 'cover', 'description', 'status', 'published_date', 'cat_id'));
    }

    public function deleteBlog($id) {
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>