<?php
namespace Admin\Models;

use PDO;

class JobCategory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Get total category count (for DataTables)
     */
    public function getCategoryCount($search = '') {
        if ($search) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM job_categories WHERE name LIKE :search");
            $stmt->execute(['search' => "%$search%"]);
        } else {
            $stmt = $this->db->query("SELECT COUNT(*) FROM job_categories");
        }
        return $stmt->fetchColumn();
    }

    /**
     * Get paginated job categories (for DataTables)
     */
    public function getPaginatedCategories($limit, $offset, $search = '') {
        if ($search) {
            $stmt = $this->db->prepare("SELECT * FROM job_categories WHERE name LIKE :search LIMIT :offset, :limit");
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM job_categories LIMIT :offset, :limit");
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all job categories
     */
    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM job_categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a job category by ID
     */
    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new category
     */
    public function createCategory($name, $status) {
        $stmt = $this->db->prepare("INSERT INTO job_categories (name, status) VALUES (?, ?)");
        return $stmt->execute([$name, $status]);
    }

    /**
     * Update an existing category
     */
    public function updateCategory($id, $name, $status) {
        $stmt = $this->db->prepare("UPDATE job_categories SET name = ?, status = ? WHERE id = ?");
        return $stmt->execute([$name, $status, $id]);
    }

    /**
     * Delete a category
     */
    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM job_categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
