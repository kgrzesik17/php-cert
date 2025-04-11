<?php

class Article {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->get_connection();
    }

    public function create($title, $content, $user_id) {
        $query = "INSERT INTO articles (title, content, author_id) VALUES (:title, :content, :user_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all() {
        $query = "SELECT articles. id, articles.title, articles.content, articles.created_date, users.username AS author_name, users.id AS author_id FROM articles JOIN users ON users.id = articles.author_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_one_by_id($id) {
        $query = "SELECT articles. id, articles.title, articles.content, articles.created_date, users.username AS author_name, users.id AS author_id FROM articles JOIN users ON users.id = articles.author_id WHERE articles.id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function delete($id) {
        // make sure only owner can delete the article
        if($_SESSION['user_id'] !== $this->get_one_by_id($id)->author_id) {
            return false;
        }

        $query = "DELETE FROM articles WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}