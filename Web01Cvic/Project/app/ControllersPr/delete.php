
<?php
require_once __DIR__ . '/../ModelsPr/database.php';
require_once __DIR__ . '/../ModelsPr/post.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../authPr/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $db = (new Database())->getConnection();
    $postModel = new Post($db);

    $post = $postModel->getById($id);
    if ($post && ($post['user_id'] == $_SESSION['user_id'] || ($_SESSION['role'] ?? '') === 'admin')) {
        if ($postModel->delete($id)) {
            header("Location: ../../app/ViewsPr/articles/edit_delete.php?deleted=1");
            exit();
        } else {
            echo "Chyba při mazání příspěvku.";
        }
    } else {
        echo "Nemáte oprávnění smazat tento příspěvek.";
    }
} else {
    echo "Neplatný požadavek.";
}

if ($success) {
    header("Location: ../../app/ViewsPr/articles/edit_delete.php?deleted=1");
    exit();
} else {
    header("Location: ../../app/ViewsPr/articles/edit_delete.php?error=delete");
    exit();
}

