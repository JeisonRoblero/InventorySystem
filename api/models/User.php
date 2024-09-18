<?php
    require_once 'config/database.php';

    class User {
        private $conn;
        private $table = 'users';

        public $id;
        public $username;
        public $email;
        public $password;
        public $oauth_id;
        public $profile_picture;
        public $oauth_provider;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection(); // Conecta a la base de datos
        }

        // Obtiene todos los usuarios
        public function getAll() {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtiene un usuario por ID
        public function getById($id) {
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

         // Obtiene un usuario por email
         public function getByEmail($email) {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
      
        // Busca un usuario por nombre
        public function searchByName($name) {
            $query = "SELECT * FROM " . $this->table . " WHERE username LIKE :name";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', "%$name%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Crea un nuevo usuario
        public function create() {
            $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (:username, :password, :email)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':email', $this->email);
            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // Retorna el ID del usuario recién creado
            }

            return null; // Retorna null si hubo algún error
        }

        // Actualiza un usuario existente
        public function update() {
            $query = "UPDATE " . $this->table . " SET username = :username, password = :password, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }
        
        // Elimina un usuario
        public function delete() {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }

        // Busca usuuario por Google ID
        public function findByGoogleId($googleId) {
            $query = "SELECT * FROM " . $this->table . " WHERE oauth_id = :google_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":google_id",$googleId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el usuario si existe
        }

        // Crea un nuevo usuario usando Google OAuth
        public function createWithGoogle($googleId, $email, $username, $profile_picture) {
            $query = "INSERT INTO " . $this->table . " (oauth_id, email, username, profile_picture, oauth_provider)
                      VALUES (:google_id, :email, :username, :profile_picture, 'google')";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':google_id', $googleId);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':profile_picture', $profile_picture);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // Retorna el ID del usuario recién creado
            }

            return null; // Retorna null si hubo algún error
        }
    }

?>