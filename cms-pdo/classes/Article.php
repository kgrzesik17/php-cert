<?php

class Article {
    private $conn;
    private $table = 'articles';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // shortens an article
    public function getExcerpt($content, $length = 100)
    {
        if(strlen($content) > $length) {
            return substr($content, 0, $length) . "...";
        }

        return $content;
    }

    // fetches an array of all articles
    public function get_all()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // fetches an article by its id 
    public function getArticleById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $article = $stmt->fetch(PDO::FETCH_OBJ);

        if($article) {
            return $article;
        } else {
            return false;
        }
    }

    // fetches a full article with its owners id by articles id
    public function getArticleWithOwnerById($id) {
        $query = "SELECT
                    articles.id,
                    articles.title, 
                    articles.content,
                    articles.created_at,
                    users.username AS author,
                    users.email AS author_email
                FROM " . $this->table . " 
                JOIN users ON articles.user_id = users.id
                WHERE articles.id = :id
                LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $article = $stmt->fetch(PDO::FETCH_OBJ);

        if($article) {
            return $article;
        } else {
            return null;
        }
    }

    // fetches an array of articles
    public function getArticlesByUser($user_id)
    {
        $query = "SELECT * FROM articles WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll(pdo::FETCH_OBJ);
    }

    // creates an article
    public function create($title, $content, $author_id, $created_at, $image) {
        $query = "INSERT INTO " . $this->table . " (title, content, user_id, created_at, image) VALUES (:title, :content, :user_id, :created_at, :image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $author_id);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    // deletes the database record alongside the image linked with it 
    public function deleteWithImage($id) {
        $article = $this->getArticleById($id);

        if($article) {
            if($article->user_id == $_SESSION['user_id']) {

                if(!empty($article->image) && file_exists($article->image)) {
                    if(!unlink($article->image)) {
                        return false;
                    }
                }
            
                $query = "DELETE FROM " . $this->table . " WHERE id = :id";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                return $stmt->execute();
            } else {
                redirect("admin.php");
            }
        }

        return false;
    }
}