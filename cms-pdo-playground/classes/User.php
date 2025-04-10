<?php

include 'Database.php';

class User {
    private $conn;
    private $table = "users";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->get_connection();
    }

    public function register ($username, $password) {
        $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);

        $stmt->execute();
    }
}