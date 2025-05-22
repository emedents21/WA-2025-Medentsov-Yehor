<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once __DIR__ . '/../ModelsPr/database.php';
require_once __DIR__ . '/../ModelsPr/post.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../authPr/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $db = (new Database())->getConnection();
    $postModel = new Post($db);

    $post = $postModel->getById($id);
    if ($post && ($post['user_id'] == $_SESSION['user_id'] || ($_SESSION['role'] ?? '') === 'admin')) {
        $success = $postModel->update($id, $title, $content);
        if ($success) {
            header("Location: ../../app/ViewsPr/articles/edit_delete.php?updated=1");
            exit();
        } else {
            echo "Chyba při aktualizaci příspěvku.";
        }
    } else {
        echo "Nemáte oprávnění upravit tento příspěvek.";
    }
} else {
    echo "Neplatný požadavek.";
}

if ($success) {
    header("Location: ../../app/ViewsPr/articles/edit_delete.php?updated=1");
    exit();
} else {
    header("Location: ../../app/ViewsPr/articles/edit_delete.php?error=update");
    exit();
}

