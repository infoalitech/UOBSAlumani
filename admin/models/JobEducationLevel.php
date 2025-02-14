<?php
namespace Admin\Models;

use PDO;
use PDOException;

class JobEducationLevel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all job education levels
     */
    public function getAllLevels() {
        try {
            $stmt = $this->db->query("SELECT * FROM education_levels ORDER BY level ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a single job education level by ID
     */
    public function getLevelById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM education_levels WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total count of education levels (for pagination)
     */
    public function getLevelCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM education_levels WHERE level LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM education_levels");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated list of education levels with search support
     */
    public function getPaginatedLevels($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT * FROM education_levels WHERE level LIKE :search LIMIT :offset, :limit");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("SELECT * FROM education_levels LIMIT :offset, :limit");
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
     * Create a new education level
     */
    public function createLevel($level) {
        try {
            $stmt = $this->db->prepare("INSERT INTO education_levels (level) VALUES (:level)");
            return $stmt->execute(['level' => trim($level)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing education level
     */
    public function updateLevel($id, $level) {
        try {
            $stmt = $this->db->prepare("UPDATE education_levels SET level = :level WHERE id = :id");
            return $stmt->execute(['id' => (int)$id, 'level' => trim($level)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete an education level by ID
     */
    public function deleteLevel($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM education_levels WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
