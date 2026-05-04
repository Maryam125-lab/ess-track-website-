<?php

namespace Config;

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->db_name = $_ENV['DB_NAME'] ?? 'ess-track-backend-db';
        $this->username = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASS'] ?? '';
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = mysqli_init();
            if (!$this->conn) {
                throw new \Exception("mysqli_init failed");
            }
            
            // Set SSL for TiDB Cloud
            $this->conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
            
            $success = $this->conn->real_connect(
                $this->host, 
                $this->username, 
                $this->password, 
                $this->db_name,
                $_ENV['DB_PORT'] ?? 4000,
                null,
                MYSQLI_CLIENT_SSL
            );

            if (!$success) {
                throw new \Exception("Connection failed: " . $this->conn->connect_error);
            }

            $this->conn->set_charset("utf8mb4");
        } catch (\Exception $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }
}

