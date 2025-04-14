<?php

class User {
    public $table = 'users';
    public $id;
    public $username;
    public $password;
    public $email;

    public $first_name;
    public $last_name;
    public $phone;
    public $birthdate;
    public $organization;
    public $location;
    public $profile_image;
    public $created_at;
    public $updated_at;

    private $conn;

    public function __construct()
    {
        // connect to the database
        $this->conn = Database::getInstance()->getConnection();
    }

    public function store() {
        $query = "INSERT INTO $this->table (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);

        if($stmt->execute()) {
            return true;
        } 

        return false;
    }

    public function login() {
        $query = "SELECT * FROM $this->table WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $this->email = sanitize($this->email);

        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $dbUser = $stmt->fetch(PDO::FETCH_OBJ);

        if($dbUser && password_verify($this->password, $dbUser->password)) {
            $this->id = $dbUser->id;
            $this->username = $dbUser->username;
            return true;
        }
        
        return false;
    }
}