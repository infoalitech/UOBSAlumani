<?php

class Blog {
    private $conn;
    private $table_name = "blogs";

    public $id;
    public $title;
    public $cover;
    public $description;
    public $status;
    public $published_date;
    public $cat_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, cover=:cover, description=:description, status=:status, published_date=:published_date, cat_id=:cat_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cover', $this->cover);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':published_date', $this->published_date);
        $stmt->bindParam(':cat_id', $this->cat_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY published_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->cover = $row['cover'];
        $this->description = $row['description'];
        $this->status = $row['status'];
        $this->published_date = $row['published_date'];
        $this->cat_id = $row['cat_id'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title=:title, cover=:cover, description=:description, status=:status, published_date=:published_date, cat_id=:cat_id WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cover', $this->cover);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':published_date', $this->published_date);
        $stmt->bindParam(':cat_id', $this->cat_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}