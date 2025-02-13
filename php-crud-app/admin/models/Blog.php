<?php
namespace Admin\Models;

use PDO;

class Blog {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function getBlogCount($search = '') {
        if (!empty($search)) {
            $query = "SELECT COUNT(*) FROM blogs WHERE title LIKE :search OR description LIKE :search";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        } else {
            $query = "SELECT COUNT(*) FROM blogs";
            $stmt = $this->db->prepare($query);
        }
    
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    
    /**
     * Get paginated blogs with search filter
     */
    public function getPaginatedBlogs($limit, $offset, $search = '') {
        $query = "
            SELECT blogs.id, blogs.title, categories.name AS category, blogs.status 
            FROM blogs 
            LEFT JOIN categories ON blogs.cat_id = categories.id
        ";
    
        $params = [];
        if (!empty($search)) {
            $query .= " WHERE blogs.title LIKE :search OR blogs.description LIKE :search";
            $params[':search'] = "%$search%";
        }
    
        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $this->db->prepare($query);
    
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
    
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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