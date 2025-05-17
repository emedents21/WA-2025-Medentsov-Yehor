<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Стартуем сессию и подключаем нужные файлы
session_start();
require_once __DIR__ . '/../../ModelsPr/database.php';
require_once __DIR__ . '/../../ModelsPr/post.php';

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../authPr/login.php");
    exit();
}

$db = (new Database())->getConnection();
$postModel = new Post($db);

$userId = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? null;

if ($role === 'admin') {
    $posts = $postModel->getAll(); // Все посты
} else {
    $posts = $postModel->getUserPosts($userId); // Только свои посты
}


// Проверяем, редактируется ли пост
$editMode = false;
$postToEdit = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $postToEdit = $postModel->getById($editId);
    if ($postToEdit && ($postToEdit['user_id'] == $userId || ($_SESSION['role'] ?? '') === 'admin')) {
        $editMode = true;
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje příspěvky – editace a mazání</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-primary text-white shadow-sm mb-4">
    <div class="container py-3 d-flex flex-wrap align-items-center justify-content-between rounded-4">
        <div class="d-flex align-items-center mb-2 mb-lg-0 gap-3">
            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" style="width:46px; height:46px;">
                <span class="fw-bold text-primary fs-5">IT</span>
            </div>
            <div>
                <h1 class="fs-4 mb-1 fw-bold text-white">
                    <a href="../articles/blog_home.php" class="text-white text-decoration-none d-inline-block">Řízení IT projektů</a>
                </h1>
                <p class="mb-0 small text-light">Technologický blog o projektovém managementu v IT</p>
                <?php if (isset($_SESSION['username'])): ?>
                  <p class="mb-0 small text-white mt-1">
                    Přihlášen jako: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                  </p>
                <?php endif; ?>
            </div>
        </div>
        <nav class="nav nav-pills flex-row gap-3 align-items-center">
            <a href="../articles/create.php" class="nav-link bg-white text-primary fw-semibold px-3 rounded">Přidat post</a>
            <a href="../articles/nastenka.php" class="nav-link text-white px-3">Nástěnka</a>
            <a href="../../authPr/login.php" class="nav-link text-white px-3">Odhlásit se</a>
        </nav>
    </div>
</header>

<main class="flex-grow-1 py-5">
    <div class="container">
        <h2 class="mb-5 text-center text-dark fw-semibold">Moje příspěvky – editace a mazání</h2>

        <?php if ($editMode): ?>
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow rounded-4 border-0">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h2>Upravit příspěvek: <?= htmlspecialchars($postToEdit['title']) ?></h2>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form action="../../ControllersPr/upgrade.php" method="post">
                            <input type="hidden" name="id" value="<?= $postToEdit['id'] ?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titulek příspěvku</label>
                                <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($postToEdit['title']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Obsah</label>
                                <textarea id="content" name="content" class="form-control" rows="5" required><?= htmlspecialchars($postToEdit['content']) ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Uložit změny</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($posts)): ?>
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($posts as $post): ?>
              <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                  <div class="card-body px-4 py-3">
                    <h5 class="card-title mb-2 text-dark"><?= htmlspecialchars($post['title']) ?></h5>
                    <p class="card-text mb-3 text-secondary">
                      <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 120, '...'))) ?>
                    </p>
                  </div>
                  <div class="card-footer bg-white border-0 rounded-bottom-4 d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                      <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?>
                    </div>
                    <div>
                      <a href="?edit=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary me-2">Upravit</a>
                      <a href="../../ControllersPr/delete.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger"
                         onclick="return confirm('Opravdu chcete smazat tento příspěvek?');">Smazat</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-info text-center">Žádný příspěvek zatím nebyl přidán.</div>
        <?php endif; ?>
    </div>
</main>

<footer class="text-center py-4 mt-auto bg-dark text-white rounded-top-4">
  <div class="container small">
    &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
  </div>
</footer>
</body>
</html>
