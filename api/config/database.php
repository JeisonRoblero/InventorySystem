<?php
require_once 'env.php';

class Database {
    private $host = "localhost";
    private $db_name = "inventory_db";
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->username = $_ENV['DB_USERNAME'] ?: '';
        $this->password = $_ENV['DB_PASSWORD'] ?: '';
    }

    // Método para obtener la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>