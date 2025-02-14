<?php
namespace Admin\Models;

use PDO;
use PDOException;

class News {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all news articles
     */
    public function getAllNews() {
        try {
            $stmt = $this->db->query("SELECT * FROM news ORDER BY date DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Get a single news article by ID
     */
    public function getNewsById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total count of news articles (for pagination)
     */
    public function getNewsCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM news WHERE name LIKE :search OR description LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM news");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated news articles (for DataTables)
     */
    public function getPaginatedNews($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT * FROM news 
                    WHERE name LIKE :search OR description LIKE :search 
                    ORDER BY date DESC
                    LIMIT :offset, :limit
                ");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("
                    SELECT * FROM news 
                    ORDER BY date DESC
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
     * Create a new news article
     */
    public function createNews($name, $desc, $status, $date, $end_date) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO news (name, description, status, date, end_date) 
                VALUES (:name, :desc, :status, :date, :end_date)
            ");
            return $stmt->execute([
                'name' => trim($name),
                'desc' => trim($desc),
                'status' => $status,
                'date' => $date,
                'end_date' => $end_date
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update an existing news article
     */
    public function updateNews($id, $name, $desc, $status, $date, $end_date) {
        try {
            $stmt = $this->db->prepare("
                UPDATE news 
                SET name = :name, description = :desc, status = :status, date = :date, end_date = :end_date 
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => (int)$id,
                'name' => trim($name),
                'desc' => trim($desc),
                'status' => $status,
                'date' => $date,
                'end_date' => $end_date
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete a news article by ID
     */
    public function deleteNews($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
