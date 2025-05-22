<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../ModelsPr/database.php';
require_once __DIR__ . '/../ModelsPr/post.php';

class PostController
{
    private $db;
    private $postModel;
     public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->postModel = new Post($this->db);
    }

    public function createPost() {
        // Kontrola, jestli je uživatel přihlášen
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../ControllersPr/post_list.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $user_id = $_SESSION['user_id'];

            // Získání ID přihlášeného uživatele
            $user_id = $_SESSION['user_id'];

            // Uložení postu do DB včetně user_id
            if ($this->postModel->createPost(
                $user_id, $title, $content
            )) {
                header("Location: ../ViewsPr/articles/post_list.php");
                exit();
            } else {
                echo "Chyba při ukládání přispěvku.";
            }
        }
    }
        public function listPosts () {
        $posts = $this->postModel->getAll();
        include '../ViewsPr/articles/post_list.php';
    }


        public function getUserPosts($userId) {
            $query = 'SELECT * FROM blog_posts WHERE user_id = :user_id ORDER BY created_at DESC';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPublicPosts() {
        $postModel = new Post($this->db);
        return $postModel->getAll();
    }


}
$controller = new PostController();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->createPost();
}


