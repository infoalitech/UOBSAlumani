<?php
namespace Admin\Models;

use PDO;
use PDOException;

class Permission {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    /**
     * Get total count of permissions (for pagination)
     */
    public function getPermissionCount($search = '') {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) FROM permissions");
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }
    /**
     * Get all permissions
     */
    public function getAllPermissions() {
        try {
            $stmt = $this->db->query("SELECT * FROM permissions ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
