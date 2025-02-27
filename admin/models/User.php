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
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, active) VALUES (:name, :email, :password, :role, :active)");
            $stmt->execute([
                'name' => trim($data['name']),
                'email' => trim($data['email']),
                'password' => $data['password'],
                'role' => trim($data['role']),
                'active' => (int) $data['active']
            ]);
            $userId = $this->db->lastInsertId();
            if (!empty($data['permissions'])) {
                $this->assignPermissions($userId, $data['permissions']);
            }

            return $userId;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get user by ID
     */
    public function read($id) {
        try {
            // Fetch user details
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Fetch user permissions
                $user['permissions'] = $this->getUserPermissions($id);
            }

            return $user;
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Update user details and permissions
     */
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email, active = :active WHERE id = :id");
            $stmt->execute([
                'id' => (int)$id,
                'name' => trim($data['name']),
                'email' => trim($data['email']),
                'active' => (int) $data['active']
            ]);

            // Remove existing permissions before assigning new ones
            $this->clearUserPermissions($id);

            if (!empty($data['permissions'])) {
                $this->assignPermissions($id, $data['permissions']);
            }

            return true;
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

    /**
     * Get user's permissions
     */
    public function getUserPermissions($userId) {

        // try {
            // Check if there are any permissions in the table
            $countStmt = $this->db->query("SELECT COUNT(*) as total FROM permissions");
            $countResult = $countStmt->fetch(\PDO::FETCH_ASSOC);
            $totalPermissions = (int) $countResult['total'];

            // If no permissions exist, insert default permissions
            if ($totalPermissions === 0) {
                $this->insertDefaultPermissions();
            }
            // Fetch user permissions
            $stmt = $this->db->prepare("
                SELECT p.id, p.slug 
                FROM permissions p 
                JOIN user_permissions up ON p.id = up.permission_id 
                WHERE up.user_id = :user_id
            ");
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOException $e) {
        //     return [];
        // }
    }

    /**
     * Assign permissions to a user
     */
    public function assignPermissions($userId, $permissions) {
        try {
            $stmt = $this->db->prepare("INSERT INTO user_permissions (user_id, permission_id) VALUES (:user_id, :permission_id)");
            foreach ($permissions as $permissionId) {
                $stmt->execute([
                    'user_id' => (int)$userId,
                    'permission_id' => (int)$permissionId
                ]);
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Remove all permissions assigned to a user
     */
    public function clearUserPermissions($userId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM user_permissions WHERE user_id = :user_id");
            $stmt->execute(['user_id' => (int)$userId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Inserts default permissions if none exist in the permissions table
     */
    private function insertDefaultPermissions() {


        // try {
            // Start a transaction
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM permissions");
            $stmt->execute();
            // Check if permissions exist
            $totalPermissions = (int) $stmt->fetchColumn();

            if ($totalPermissions === 0) {
                // Insert all permissions
                $stmt = $this->db->prepare("INSERT INTO permissions (slug, name) VALUES 
                    ('access_dashboard', 'Access the admin dashboard'),
                
                    ('view_users', 'View user list'),
                    ('create_users', 'Create new users'),
                    ('edit_users', 'Edit user details'),
                    ('delete_users', 'Delete users'),
                    ('manage_permissions', 'Assign and modify user permissions'),
                
                    ('view_permissions', 'View all permissions'),
                    ('create_permissions', 'Create new permissions'),
                    ('edit_permissions', 'Edit permissions'),
                    ('delete_permissions', 'Delete permissions'),
                
                    ('view_admin_blogs', 'View all blog posts in admin'),
                    ('create_blogs', 'Create new blog posts'),
                    ('edit_blogs', 'Edit existing blog posts'),
                    ('delete_blogs', 'Delete blog posts'),
                
                    ('view_blog_categories', 'View blog categories'),
                    ('create_blog_categories', 'Create new blog categories'),
                    ('edit_blog_categories', 'Edit blog categories'),
                    ('delete_blog_categories', 'Delete blog categories'),
                
                    ('view_admin_jobs', 'View all jobs in admin'),
                    ('create_jobs', 'Create new job postings'),
                    ('edit_jobs', 'Edit existing job postings'),
                    ('delete_jobs', 'Delete job postings'),
                
                    ('view_job_categories', 'View job categories'),
                    ('create_job_categories', 'Create new job categories'),
                    ('edit_job_categories', 'Edit job categories'),
                    ('delete_job_categories', 'Delete job categories'),
                
                    ('view_job_education', 'View job education levels'),
                    ('create_job_education', 'Create job education levels'),
                    ('edit_job_education', 'Edit job education levels'),
                    ('delete_job_education', 'Delete job education levels'),
                
                    ('view_job_fields', 'View job fields'),
                    ('create_job_fields', 'Create job fields'),
                    ('edit_job_fields', 'Edit job fields'),
                    ('delete_job_fields', 'Delete job fields'),
                
                    ('view_job_types', 'View job types'),
                    ('create_job_types', 'Create job types'),
                    ('edit_job_types', 'Edit job types'),
                    ('delete_job_types', 'Delete job types'),
                
                    ('view_admin_news', 'View all news articles in admin'),
                    ('create_news', 'Create new news articles'),
                    ('edit_news', 'Edit existing news articles'),
                    ('delete_news', 'Delete news articles')
                ");
                $stmt->execute();
            }
    
            // Commit transaction
            $this->db->commit();
        // } catch (PDOException $e) {
        //     $this->db->rollBack();
        //     error_log('Error inserting default permissions: ' . $e->getMessage());
        // }
    }
    

}
?>
