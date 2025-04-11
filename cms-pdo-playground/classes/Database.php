<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'cms_pdo_db_playground';

    public $conn;

    public function get_connection() {
       $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
       
       return $this->conn;
    }
}