<?php
namespace Admin\Models;

use PDO;
use PDOException;

class JobPost {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all job posts
     */
    public function getAllJobPosts() {
        try {
            $stmt = $this->db->query("
                SELECT jp.*, jc.name AS category_name, jf.name AS field_name, jt.name AS type_name, jel.level AS education_level 
                FROM job_posts jp
                LEFT JOIN job_categories jc ON jp.category_id = jc.id
                LEFT JOIN job_fields jf ON jp.field_id = jf.id
                LEFT JOIN job_types jt ON jp.type_id = jt.id
                LEFT JOIN   education_levels jel ON jp.level_id = jel.id
                ORDER BY jp.open_date DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getLatestJobs($limit = 3) {
        $stmt = $this->db->prepare("SELECT * FROM job_posts ORDER BY open_date DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get a single job post by ID
     */
    public function getJobPostById($id) {
        try {
            $stmt = $this->db->prepare("
                SELECT jp.*, jc.name AS category_name, jf.name AS field_name, jt.name AS type_name, jel.level AS education_level 
                FROM job_posts jp
                LEFT JOIN job_categories jc ON jp.category_id = jc.id
                LEFT JOIN job_fields jf ON jp.field_id = jf.id
                LEFT JOIN job_types jt ON jp.type_id = jt.id
                LEFT JOIN   education_levels jel ON jp.level_id = jel.id
                WHERE jp.id = :id
            ");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Get total count of job posts (for pagination)
     */
    public function getJobPostCount($search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT COUNT(*) FROM job_posts 
                    WHERE title LIKE :search OR organization LIKE :search
                ");
                $stmt->execute(['search' => "%$search%"]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) FROM job_posts");
            }
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Get paginated job posts (for DataTables)
     */
    public function getPaginatedJobPosts($limit, $offset, $search = '') {
        try {
            if ($search) {
                $stmt = $this->db->prepare("
                    SELECT jp.*, jc.name AS category_name, jf.name AS field_name, jt.name AS type_name, jel.level AS education_level 
                    FROM job_posts jp
                    LEFT JOIN job_categories jc ON jp.category_id = jc.id
                    LEFT JOIN job_fields jf ON jp.field_id = jf.id
                    LEFT JOIN job_types jt ON jp.type_id = jt.id
                    LEFT JOIN   education_levels jel ON jp.level_id = jel.id
                    WHERE jp.title LIKE :search OR jp.organization LIKE :search
                    ORDER BY jp.open_date DESC
                    LIMIT :offset, :limit
                ");
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare("
                    SELECT jp.*, jc.name AS category_name, jf.name AS field_name, jt.name AS type_name, jel.level AS education_level 
                    FROM job_posts jp
                    LEFT JOIN job_categories jc ON jp.category_id = jc.id
                    LEFT JOIN job_fields jf ON jp.field_id = jf.id
                    LEFT JOIN job_types jt ON jp.type_id = jt.id
                    LEFT JOIN   education_levels jel ON jp.level_id = jel.id
                    ORDER BY jp.open_date DESC
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

    public function createJobPost($data) {
        $stmt = $this->db->prepare("INSERT INTO job_posts 
            (title, description, requirement, organization, post_link, apply_link, type_id, category_id, field_id, level_id, country, open_date, last_date, inserted_by, image) 
            VALUES (:title, :description, :requirement, :organization, :post_link, :apply_link, :type_id, :category_id, :field_id, :level_id, :country, :open_date, :last_date, :inserted_by, :image)");
    
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'requirement' => $data['requirement'],
            'organization' => $data['organization'],
            'post_link' => $data['post_link'] ?? null,
            'apply_link' => $data['apply_link'] ?? null,
            'type_id' => $data['type_id'],
            'category_id' => $data['category_id'],
            'field_id' => $data['field_id'],
            'level_id' => $data['level_id'],
            'country' => $data['country'],
            'open_date' => $data['open_date'],
            'last_date' => $data['last_date'],
            'inserted_by' => $data['inserted_by'],
            'image' => $data['image'] ?? null
        ]);
    }
    
    public function updateJobPost($id, $data) {
        $stmt = $this->db->prepare("UPDATE job_posts 
            SET title=:title, description=:description, requirement=:requirement, organization=:organization, 
            post_link=:post_link, apply_link=:apply_link, type_id=:type_id, category_id=:category_id, field_id=:field_id, 
            level_id=:level_id, country=:country, open_date=:open_date, last_date=:last_date, image=:image
            WHERE id=:id");
    
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'requirement' => $data['requirement'],
            'organization' => $data['organization'],
            'post_link' => $data['post_link'] ?? null,
            'apply_link' => $data['apply_link'] ?? null,
            'type_id' => $data['type_id'],
            'category_id' => $data['category_id'],
            'field_id' => $data['field_id'],
            'level_id' => $data['level_id'],
            'country' => $data['country'],
            'open_date' => $data['open_date'],
            'last_date' => $data['last_date'],
            'image' => $data['image'] ?? null
        ]);
    }
    

    /**
     * Delete a job post by ID
     */
    public function deleteJobPost($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM job_posts WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }


    public function incrementView($id) {
        $stmt = $this->db->prepare("UPDATE job_posts SET views = views + 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function incrementLike($id) {
        $stmt = $this->db->prepare("UPDATE job_posts SET likes = likes + 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function incrementClick($id) {
        $stmt = $this->db->prepare("UPDATE job_posts SET clicks = clicks + 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getTotalViews() {
        $stmt = $this->db->query("SELECT SUM(views) AS total FROM job_posts");
        return $stmt->fetchColumn() ?: 0;
    }
    
    public function getTotalClicks() {
        $stmt = $this->db->query("SELECT SUM(clicks) AS total FROM job_posts");
        return $stmt->fetchColumn() ?: 0;
    }
    public function fetchFilteredJobPosts($filters) {
        $page = $filters['page'] ?? 1;
        $limit = $filters['limit'] ?? 6;
        $offset = ($page - 1) * $limit;
    
        // Ensure these filters are arrays and properly handle empty values
        $types = isset($filters['type']) 
            ? (is_array($filters['type']) ? array_filter($filters['type']) : array_filter(explode(',', $filters['type']))) 
            : [];

        $categories = isset($filters['category']) 
            ? (is_array($filters['category']) ? array_filter($filters['category']) : array_filter(explode(',', $filters['category']))) 
            : [];

        $levels = isset($filters['level']) 
            ? (is_array($filters['level']) ? array_filter($filters['level']) : array_filter(explode(',', $filters['level']))) 
            : [];
        $fields = isset($filters['fields']) 
            ? (is_array($filters['fields']) ? array_filter($filters['fields']) : array_filter(explode(',', $filters['fields']))) 
            : [];
            
        $search = $filters['search'] ?? '';

            

        // try {
            $query = "SELECT jp.*, jc.name AS category_name, jf.name AS field_name, jt.name AS type_name, jel.level AS education_level 
                      FROM job_posts jp
                      LEFT JOIN job_categories jc ON jp.category_id = jc.id
                      LEFT JOIN job_fields jf ON jp.field_id = jf.id
                      LEFT JOIN job_types jt ON jp.type_id = jt.id
                      LEFT JOIN education_levels jel ON jp.level_id = jel.id
                      WHERE 1=1";
    
            $params = [];
            // print_r( $types);
            // print_r( count($types));
            // exit();
            // Handling multiple types
            if (!empty($types)) {
                $placeholders = implode(',', array_fill(0, count($types), '?'));
                $query .= " AND jp.type_id IN ($placeholders)";
                $params = array_merge($params, $types);
                // print_r($params);
                // exit();
            }

            // Handling multiple categories
            if (!empty($categories)) {
                $placeholders = implode(',', array_fill(0, count($categories), '?'));
                $query .= " AND jp.category_id IN ($placeholders)";
                $params = array_merge($params, $categories);
            }
    
            // Handling multiple education levels
            if (!empty($levels)) {
                $placeholders = implode(',', array_fill(0, count($levels), '?'));
                $query .= " AND jp.level_id IN ($placeholders)";
                $params = array_merge($params, $levels);
            }
    
            // Handling multiple education levels
            if (!empty($fields)) {
                $placeholders = implode(',', array_fill(0, count($fields), '?'));
                $query .= " AND jp.field_id IN ($placeholders)";
                $params = array_merge($params, $fields);
            }
    
            // Search filter
            if (!empty($search)) {
                $query .= " AND (jp.title LIKE ? OR jp.description LIKE ? OR jp.organization LIKE ?)";
                array_push($params, "%$search%", "%$search%", "%$search%");
            }
    
            $query .= " ORDER BY jp.open_date DESC LIMIT ?, ?";
            $params[] = (int)$offset;
            $params[] = (int)$limit;
    
            $stmt = $this->db->prepare($query);
    
            // Ensure the correct number of parameters are bound
            foreach ($params as $index => $param) {
                $stmt->bindValue($index + 1, $param, is_numeric($param) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
        // exit();
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOException $e) {
        //     error_log($e->getMessage());
        //     return [];
        // }
    }
    
    
}
?>
