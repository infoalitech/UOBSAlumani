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
    
}
?>
