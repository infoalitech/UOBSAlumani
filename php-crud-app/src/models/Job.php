<?php

class Job {
    private $conn;
    private $table_name = "job_posts";

    public $id;
    public $open_date;
    public $last_date;
    public $title;
    public $description;
    public $requirement;
    public $organization;
    public $post_link;
    public $apply_link;
    public $type_id;
    public $insert_date;
    public $inserted_by;
    public $category_id;
    public $field_id;
    public $level_id;
    public $country;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET open_date = :open_date, 
                      last_date = :last_date, 
                      title = :title, 
                      description = :description, 
                      requirement = :requirement, 
                      organization = :organization, 
                      post_link = :post_link, 
                      apply_link = :apply_link, 
                      type_id = :type_id, 
                      inserted_by = :inserted_by, 
                      category_id = :category_id, 
                      field_id = :field_id, 
                      level_id = :level_id, 
                      country = :country";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':open_date', $this->open_date);
        $stmt->bindParam(':last_date', $this->last_date);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':requirement', $this->requirement);
        $stmt->bindParam(':organization', $this->organization);
        $stmt->bindParam(':post_link', $this->post_link);
        $stmt->bindParam(':apply_link', $this->apply_link);
        $stmt->bindParam(':type_id', $this->type_id);
        $stmt->bindParam(':inserted_by', $this->inserted_by);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':field_id', $this->field_id);
        $stmt->bindParam(':level_id', $this->level_id);
        $stmt->bindParam(':country', $this->country);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY open_date DESC";
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

        $this->open_date = $row['open_date'];
        $this->last_date = $row['last_date'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->requirement = $row['requirement'];
        $this->organization = $row['organization'];
        $this->post_link = $row['post_link'];
        $this->apply_link = $row['apply_link'];
        $this->type_id = $row['type_id'];
        $this->inserted_by = $row['inserted_by'];
        $this->category_id = $row['category_id'];
        $this->field_id = $row['field_id'];
        $this->level_id = $row['level_id'];
        $this->country = $row['country'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET open_date = :open_date, 
                      last_date = :last_date, 
                      title = :title, 
                      description = :description, 
                      requirement = :requirement, 
                      organization = :organization, 
                      post_link = :post_link, 
                      apply_link = :apply_link, 
                      type_id = :type_id, 
                      category_id = :category_id, 
                      field_id = :field_id, 
                      level_id = :level_id, 
                      country = :country 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':open_date', $this->open_date);
        $stmt->bindParam(':last_date', $this->last_date);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':requirement', $this->requirement);
        $stmt->bindParam(':organization', $this->organization);
        $stmt->bindParam(':post_link', $this->post_link);
        $stmt->bindParam(':apply_link', $this->apply_link);
        $stmt->bindParam(':type_id', $this->type_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':field_id', $this->field_id);
        $stmt->bindParam(':level_id', $this->level_id);
        $stmt->bindParam(':country', $this->country);
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