<?php 
class Post {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function createPost($user_id, $title, $content) {
        // Сначала проверим, существует ли пользователь с указанным ID
        $checkUserSql = "SELECT COUNT(*) FROM blog_users WHERE id = :user_id";
        $checkStmt = $this->conn->prepare($checkUserSql);
        $checkStmt->bindParam(':user_id', $user_id);
        $checkStmt->execute();
        
        if ($checkStmt->fetchColumn() == 0) {
            // Пользователь не существует
            error_log("User with ID $user_id does not exist in blog_users table");
            return false;
        }
        
        // Если пользователь существует, продолжаем создание поста
        $sql = "INSERT INTO blog_posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error creating post: " . $e->getMessage());
            return false;
        }
    }
    
    public function getAll() {
        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>