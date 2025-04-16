<?php

// for data stuff

class User {
    public $table = 'users';

    private $uploadDir = "uploads/users";

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

    public function getUserById($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function update($userId, $userData) {
        $fields = [];

        foreach($userData as $key => $value) {
            $fields[] = "{$key} = :{$key}";
        }

        $query = "UPDATE $this->table SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        foreach($userData as $key => $value) {
            // // my solution
            // if($key == "birthday" && !$value) {
            //     $stmt->bindValue(":{$key}", "1970-01-01");
            // }
            // else{
            //     $stmt->bindValue(":{$key}", $value);
            // }
            
            if($value === '') {
                $stmt->bindValue(":{$key}", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":{$key}", $value);
            }
        }

        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updatePassword($userId, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE {$this->table} SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function handleImageUpload($file) {
        $maxSize = 5 * 1024 * 1024;  // max file size 5MB
        $tempLocation = $file['tmp_name'];  // temporary file location
        
        if($file['size'] > $maxSize) {  // chec max file size
            $_SESSION['error'] = "FILE IS TOO BIG";
            return false;
        }

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('user_', true) . '.' . $fileExtension;

        if(!file_exists($this->uploadDir)) {  // make sure files aren't overriden
            mkdir($this->uploadDir, 0755, true);
        }

        $filePath = $this->uploadDir . '/' . $filename;

        if(move_uploaded_file($tempLocation, $filePath)) {
            return $filePath;
        } else {
            $_SESSION['error'] == "Failed to upload from user model";
            return false;
        }
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
            $this->first_name = $dbUser->first_name;
            $this->last_name = $dbUser->last_name;
            return true;
        }
        
        return false;
    }
}