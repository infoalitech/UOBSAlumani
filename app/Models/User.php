<?php

namespace App\Models;

use Database;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($email, $name, $password, $active) {
        $stmt = $this->db->prepare("INSERT INTO users (email, name, password, active) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$email, $name, password_hash($password, PASSWORD_BCRYPT), $active]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}