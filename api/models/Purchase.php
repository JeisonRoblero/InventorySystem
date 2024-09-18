<?php
require_once 'config/database.php';

class Purchase {
    private $conn;
    private $table = 'purchases';

    public $id;
    public $user_id;
    public $product_id;
    public $quantity;
    public $status;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); // Conecta a la base de datos
    }

    // Obtiene todas las compras
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene una compra por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUserId() {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca compras por ID de usuario o producto
    public function searchByUserIdOrProductId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :id OR product_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crea una nueva compra
    public function create() {
        $query = "INSERT INTO " . $this->table . " (user_id, product_id, quantity, status) VALUES (:user_id, :product_id, :quantity, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        return $stmt->execute();
    }

    // Actualiza una compra existente
    public function update() {
        $query = "UPDATE " . $this->table . " SET user_id = :user_id, product_id = :product_id, quantity = :quantity, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Elimina una compra
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
