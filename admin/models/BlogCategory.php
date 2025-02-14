<?php
namespace Admin\Models;

use PDO;
use PDOException;

class BlogCategory {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all blog categories
     */
    public function getAllCategories() {
        try {
            $stmt = $this->db->query("SELECT * FROM blog_categories ORDER BY name ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a single blog category by ID
     */
    public function getCategoryById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM blog_categories WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total count of blog categories (for pagination)
     */
    public function getCategoryCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM blog_categories WHERE name LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM blog_categories");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated blog categories (for DataTables)
     */
    public function getPaginatedCategories($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT * FROM blog_categories 
                    WHERE name LIKE :search 
                    ORDER BY name ASC
                    LIMIT :offset, :limit
                ");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("
                    SELECT * FROM blog_categories 
                    ORDER BY name ASC
                    LIMIT :offset, :limit
                ");
            }
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Create a new blog category
     */
    public function createCategory($name) {
        try {
            $stmt = $this->db->prepare("INSERT INTO blog_categories (name) VALUES (:name)");
            return $stmt->execute(['name' => trim($name)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing blog category
     */
    public function updateCategory($id, $name) {
        try {
            $stmt = $this->db->prepare("UPDATE blog_categories SET name = :name WHERE id = :id");
            return $stmt->execute(['id' => (int)$id, 'name' => trim($name)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete a blog category by ID
     */
    public function deleteCategory($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM blog_categories WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
