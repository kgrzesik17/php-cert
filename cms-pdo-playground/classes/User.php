<?php

class User{
    private $conn;

    public function __construct() 
    {
        // make a connection with db
        $database = new Database(); 
        $this->conn = $database->get_connection();
    }

    public function check_if_username_exists($username) {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }

    // register a new user 
    public function register($username, $password) {
        if(strlen($password) < 5) {  // check if password is at least 5 characters long
            return "Error: Password must be at least 5 characters long";
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if(!$this->check_if_username_exists($username)) {
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return "Error: Username already exists.";
        }
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if(empty($result)) {
            return "Error: Username not found";
        }

        if(password_verify($password, $result->password)) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $result->id;
            $_SESSION['username'] = $result->username;
            return true;
        } else {
            return "Error: Incorrect password";
        }
    }

    public function get_info_by_id($id) {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_name_by_id($id) {
        $query = "SELECT username FROM users WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
}