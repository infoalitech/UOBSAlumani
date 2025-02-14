<?php
namespace Admin\Models;

use PDO;

class JobPost {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllJobPosts() {
        $stmt = $this->db->query("SELECT * FROM job_posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJobPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM job_posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createJobPost($title, $desc, $requirement, $organization, $post_link, $apply_link, $type_id, $category_id, $field_id, $level_id, $country, $open_date, $last_date, $inserted_by) {
        $stmt = $this->db->prepare("INSERT INTO job_posts (title, desc, requirement, organization, post_link, apply_link, type_id, category_id, field_id, level_id, country, open_date, last_date, inserted_by) VALUES (:title, :desc, :requirement, :organization, :post_link, :apply_link, :type_id, :category_id, :field_id, :level_id, :country, :open_date, :last_date, :inserted_by)");
        return $stmt->execute(compact('title', 'desc', 'requirement', 'organization', 'post_link', 'apply_link', 'type_id', 'category_id', 'field_id', 'level_id', 'country', 'open_date', 'last_date', 'inserted_by'));
    }

    public function updateJobPost($id, $title, $desc, $requirement, $organization, $post_link, $apply_link, $type_id, $category_id, $field_id, $level_id, $country, $open_date, $last_date, $inserted_by) {
        $stmt = $this->db->prepare("UPDATE job_posts SET title = :title, desc = :desc, requirement = :requirement, organization = :organization, post_link = :post_link, apply_link = :apply_link, type_id = :type_id, category_id = :category_id, field_id = :field_id, level_id = :level_id, country = :country, open_date = :open_date, last_date = :last_date, inserted_by = :inserted_by WHERE id = :id");
        return $stmt->execute(compact('id', 'title', 'desc', 'requirement', 'organization', 'post_link', 'apply_link', 'type_id', 'category_id', 'field_id', 'level_id', 'country', 'open_date', 'last_date', 'inserted_by'));
    }

    public function deleteJobPost($id) {
        $stmt = $this->db->prepare("DELETE FROM job_posts WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>