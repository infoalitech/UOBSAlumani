<?php 
/* Database.php */
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . Config::get("DB_HOST") . ";dbname=" . Config::get("DB_NAME"),
            Config::get("DB_USER"),
            Config::get("DB_PASS")
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Execute migration script to create tables if they do not exist
        $sql = file_get_contents(__DIR__ . '/../migrations/create_tables.sql');
        $this->conn->exec($sql);

        // Insert test user if not exists
        $user = new User();
        if (!$user->exists("test@example.com")) {
            $user->create("test@example.com", "Test User", "password", 1);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

