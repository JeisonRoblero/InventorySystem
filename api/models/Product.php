<?php
require_once 'config/database.php';

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $description;
    public $picture;
    public $price;
    public $stock;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtiene todos los productos
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un producto por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Busca productos por nombre
    public function searchByName($name) {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':name', "%$name%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crea un nuevo producto
    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, description, picture, price, stock) VALUES (:name, :description, :picture, :price, :stock)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':picture', $this->picture);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        return $stmt->execute();
    }

    // Actualiza un producto
    public function update() {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, picture = :picture, price = :price, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':picture', $this->picture);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        return $stmt->execute();
    }

    // Elimina un producto
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
