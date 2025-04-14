<?php

class Database {

    private static $instance = null;
    private $connection;

    public function __construct()
    {
        $host = config('database.host');
        $dbname = config('database.database');
        $username = config('database.username');
        $password = config('database.password');
        $charset = config('database.charset');

        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __clone() {} // make sure no more copies of this can be created

    public function __wakeup() {} // helps to reestablish db connection if needed

    

}