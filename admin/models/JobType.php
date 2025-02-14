<?php
namespace Admin\Models;

use PDO;
use PDOException;

class JobType {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all job types
     */
    public function getAllTypes() {
        try {
            $stmt = $this->db->query("SELECT * FROM job_types ORDER BY name ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a single job type by ID
     */
    public function getTypeById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM job_types WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total job type count (for pagination)
     */
    public function getTypeCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM job_types WHERE name LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM job_types");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated job types (for DataTables)
     */
    public function getPaginatedTypes($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT * FROM job_types 
                    WHERE name LIKE :search 
                    ORDER BY name ASC
                    LIMIT :offset, :limit
                ");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("
                    SELECT * FROM job_types 
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
     * Create a new job type
     */
    public function createType($name) {
        try {
            $stmt = $this->db->prepare("INSERT INTO job_types (name) VALUES (:name)");
            return $stmt->execute(['name' => trim($name)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing job type
     */
    public function updateType($id, $name) {
        try {
            $stmt = $this->db->prepare("UPDATE job_types SET name = :name WHERE id = :id");
            return $stmt->execute(['id' => (int)$id, 'name' => trim($name)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete a job type by ID
     */
    public function deleteType($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM job_types WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
