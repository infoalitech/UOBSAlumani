<?php
namespace Admin\Models;

use PDO;
use PDOException;

class JobField {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all job fields
     */
    public function getAllFields() {
        try {
            $stmt = $this->db->query("SELECT * FROM job_fields ORDER BY name ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a single job field by ID
     */
    public function getFieldById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM job_fields WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total field count (for pagination)
     */
    public function getFieldCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM job_fields WHERE name LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM job_fields");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated list of fields
     */
    public function getPaginatedFields($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT * FROM job_fields WHERE name LIKE :search LIMIT :offset, :limit");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("SELECT * FROM job_fields LIMIT :offset, :limit");
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
     * Create a new field
     */
    public function createField($name, $status) {
        try {
            $stmt = $this->db->prepare("INSERT INTO job_fields (name, status) VALUES (:name, :status)");
            return $stmt->execute(['name' => trim($name), 'status' => $status]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing field
     */
    public function updateField($id, $name, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE job_fields SET name = :name, status = :status WHERE id = :id");
            return $stmt->execute(['id' => (int)$id, 'name' => trim($name), 'status' => $status]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete a field by ID
     */
    public function deleteField($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM job_fields WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
