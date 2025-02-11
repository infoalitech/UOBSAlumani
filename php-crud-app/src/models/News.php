<?php

class News {
    private $conn;
    private $table_name = "news";

    public $id;
    public $name;
    public $description;
    public $status;
    public $date;
    public $end_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, status=:status, date=:date, end_date=:end_date";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":end_date", $this->end_date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->status = $row['status'];
        $this->date = $row['date'];
        $this->end_date = $row['end_date'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, status = :status, date = :date, end_date = :end_date WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}