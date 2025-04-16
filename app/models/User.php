<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET name = :name, 
                      email = :email, 
                      password = :password';

        $stmt = $this->db->prepare($query);

        // Limpiar datos
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Encriptar contraseña
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Vincular valores
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function emailExists() {
        $query = 'SELECT id FROM ' . $this->table . ' WHERE email = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
}