<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../ModelsPr/database.php';
require_once '../ModelsPr/post.php';
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
            // Изменение: вызываем метод createPost вместо create
            if ($this->postModel->createPost(
                $user_id, $title, $content
            )) {
                header("Location: ../ControllersPr/post_list.php");
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


}


// // Проверка, авторизован ли пользователь
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /views/login.php");
//     exit;
// }

// // Проверка метода формы
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $title = trim($_POST['title']);
//     $content = trim($_POST['content']);
//     $user_id = $_SESSION['user_id'];

//     if (!empty($title) && !empty($content)) {
//         $post = new Post($db);
//         $post->createPost($user_id, $title, $content);
//         header("Location: /views/posts/index.php"); // после публикации — на список постов
//         exit;
//     } else {
//         echo "Vyplňte prosím všechna pole.";
//     }
// } else {
//     header("Location: /views/posts/create.php");
//     exit;
// }

// Volání metody při odeslání formuláře
$controller = new PostController();

// Zavolá pouze pokud šlo o POST request (odeslání formuláře)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->createPost();
}


// //////////////
// <?php
// session_start();

// require_once '../models/Database.php';
// require_once '../models/Book.php';

// class BookController {
//     private $db;
//     private $bookModel;

//     public function __construct() {
//         $database = new Database();
//         $this->db = $database->getConnection();
//         $this->bookModel = new Book($this->db);
//     }

//     public function createBook() {
//         // Kontrola, jestli je uživatel přihlášen
//         if (!isset($_SESSION['user_id'])) {
//             header("Location: ../controllers/book_list.php");
//             exit();
//         }

//         if ($_SERVER["REQUEST_METHOD"] == "POST") {
//             $title = htmlspecialchars($_POST['title']);
//             $author = htmlspecialchars($_POST['author']);
//             $category = htmlspecialchars($_POST['category']);
//             $subcategory = !empty($_POST['subcategory']) ? htmlspecialchars($_POST['subcategory']) : null;
//             $year = intval($_POST['year']);
//             $price = floatval($_POST['price']);
//             $isbn = htmlspecialchars($_POST['isbn']);
//             $description = htmlspecialchars($_POST['description']);
//             $link = htmlspecialchars($_POST['link']);

//             // Získání ID přihlášeného uživatele
//             $user_id = $_SESSION['user_id'];

//             // Zpracování nahraných obrázků
//             $imagePaths = [];
//             if (!empty($_FILES['images']['name'][0])) {
//                 $uploadDir = '../public/images/';
//                 foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
//                     $filename = basename($_FILES['images']['name'][$key]);
//                     $targetPath = $uploadDir . $filename;

//                     if (move_uploaded_file($tmp_name, $targetPath)) {
//                         $imagePaths[] = '/public/images/' . $filename; // Relativní cesta
//                     }
//                 }
//             }

//             // Uložení knihy do DB včetně user_id
//             if ($this->bookModel->create(
//                 $title, $author, $category, $subcategory, $year,
//                 $price, $isbn, $description, $link, $imagePaths, $user_id
//             )) {
//                 header("Location: ../controllers/book_list.php");
//                 exit();
//             } else {
//                 echo "Chyba při ukládání knihy.";
//             }
//         }
//     }

//     public function listBooks () {
//         $books = $this->bookModel->getAll();
//         include '../views/books/book_list.php';
//     }
// }

// // Volání metody při odeslání formuláře
// $controller = new BookController();

// // Zavolá pouze pokud šlo o POST request (odeslání formuláře)
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $controller->createBook();
// }
