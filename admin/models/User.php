<?php
namespace Admin\Models;

use PDO;
use PDOException;

class User {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Create a new user
     */
    public function create($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO users (name, email, role) VALUES (:name, :email, :role)");
            return $stmt->execute([
                'name' => trim($data['name']),
                'email' => trim($data['email']),
                'role' => trim($data['role'])
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get user by ID
     */
    public function read($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Update user details
     */
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
            return $stmt->execute([
                'id' => (int)$id,
                'name' => trim($data['name']),
                'email' => trim($data['email']),
                'role' => trim($data['role'])
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Delete user by ID
     */
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get total count of users (for pagination)
     */
    public function getUserCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE name LIKE :search OR email LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM users");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated users with search support
     */
    public function getPaginatedUsers($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT * FROM users 
                    WHERE name LIKE :search OR email LIKE :search 
                    ORDER BY id DESC
                    LIMIT :offset, :limit
                ");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("
                    SELECT * FROM users 
                    ORDER BY id DESC
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
     * Get all users
     */
    public function getAllUsers() {
        try {
            $stmt = $this->db->query("SELECT * FROM users ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
