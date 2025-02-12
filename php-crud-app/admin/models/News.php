<?php
namespace Admin\Models;

use PDO;

class News {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllNews() {
        $stmt = $this->db->query("SELECT * FROM news");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews($name, $desc, $status, $date, $end_date) {
        $stmt = $this->db->prepare("INSERT INTO news (name, description, status, date, end_date) VALUES (:name, :desc, :status, :date, :end_date)");
        return $stmt->execute(compact('name', 'desc', 'status', 'date', 'end_date'));
    }

    public function updateNews($id, $name, $desc, $status, $date, $end_date) {
        $stmt = $this->db->prepare("UPDATE news SET name = :name, description = :desc, status = :status, date = :date, end_date = :end_date WHERE id = :id");
        return $stmt->execute(compact('id', 'name', 'desc', 'status', 'date', 'end_date'));
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>