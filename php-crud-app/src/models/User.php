<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $name;
    public $password;
    public $active;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (email, name, password) VALUES (:email, :name, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT id, email, name, active FROM " . $this->table_name . " WHERE active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET email = :email, name = :name, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
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

    public function login() {
        $query = "SELECT id, email, password FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                return true;
            }
        }

        return false;
    }
}