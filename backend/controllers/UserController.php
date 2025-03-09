<?php
require_once "db.php"; 

class UserController {
    private $conn;
    private $table = "users";

    public function __construct() { // Constructor para conectar a la base de datos
        $database = new Database();
        $this->conn = $database->connect(); // Conexion PDO a la base de datos
    }

    // GET usuarios
    public function getUsers() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET por ID
    public function getUserById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // POST usuario
    public function createUser($name, $email, $phone) {
        $sql = "INSERT INTO " . $this->table . " (name, email, phone) VALUES (:name, :email, :phone)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);

        return $stmt->execute();
    }

    // UPDATE usuario 
    public function updateUser($id, $name, $email, $phone) {
        $sql = "UPDATE " . $this->table . " SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);

        return $stmt->execute();
    }

    // DELETE usuario
    public function deleteUser($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>