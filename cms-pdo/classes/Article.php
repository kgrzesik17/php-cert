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

        // make sure that user who tries to access the article is the owner
        if($article) {  
            if($article->user_id == $_SESSION['user_id']) {
                return $article;       
            }
        }
        redirect('admin.php');
    }

    // fetches a full article with its owners id by articles id
    public function getArticleWithOwnerById($id) {
        $query = "SELECT
                    articles.id,
                    articles.title, 
                    articles.content,
                    articles.created_at,
                    articles.image,
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

    public function uploadImage($file) {
        $targetDir = 'uploads/';
    
        if(!is_dir($targetDir)) {  // check if uploads directory exists and if not, create one
            mkdir($targetDir, 0755, true);
        }
        
        if(isset($file) && $file['error'] === 0) {  // check if everthing went alrigh with the form
            
            $targetFile = $targetDir . basename($file['name']);  // dir + filename
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); 
    
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; 
    
            if(in_array($imageFileType, $allowedTypes)) {
    
                $uniqueFileName = uniqid() . "_" . time() . "." . $imageFileType;  // add an unique id and timestamp to the name to avoid name conflicts
                $targetFile = $targetFile . $uniqueFileName;  // path/name+random+date.extension
    
                if(move_uploaded_file($file['tmp_name'], $targetFile)) {  // move the file from temp to permanent locaiton
                    return $targetFile;
                } else {
                    return "There was an error uploading the file";
                }
            } else {
                return "Only jpg, jpeg, png, gif files are allowed";
            }
        }

        return "";
    }

    public function update($id, $title, $content, $author_id, $created_at, $imagePath) {
        $query = "UPDATE " . $this->table . " SET
                                                title = :title,
                                                content = :content,
                                                user_id = :user_id,
                                                created_at = :created_at";

        if($imagePath) {  // check if there is an image uploaded
            $query .= ", image = :image";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $author_id);
        $stmt->bindParam(':created_at', $created_at);

        if($imagePath) {
            $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    public function generateDummyData($num = 10) {
        $query = "INSERT INTO " . $this->table . " (title, content, user_id, created_at, image)
        VALUES (:title, :content, :user_id, :created_at, :image)";

        $stmt = $this->conn->prepare($query);

        $dummy_content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.";
        $dummy_image = "https://placehold.co/350x200";
        $user_id = 14;
        $created_at = date('Y-m-d');

        for($i = 0; $i < $num; $i++) {
            $title = $this->randomTitleGenerator();

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $dummy_content);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->bindParam(':image', $dummy_image);

            $stmt->execute();
        }

        return true;
    }

    public function randomTitleGenerator() {
        $first = ["Future of ", "Importance of ", "Understanding ", "The power of ", "The benefits of "];
        $second = ["Technology", "Education", "Healthy Living", "World of Science", "Mental Health", "Positive Thinking", "Freedom"];

        return $first[array_rand($first)] . $second[array_rand($second)];
    }
}