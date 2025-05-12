<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../ControllersPr/PostController.php';
// Получение данных о текущем пользователе
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];  // Идентификатор текущего пользователя
    $controller = new PostController();
    $posts = $controller->getUserPosts($userId);  // Получаем посты только для текущего пользователя
} else {
    $posts = [];
    echo '<div class="alert alert-warning">Musíte být přihlášeni, abyste viděli vaše příspěvky.</div>';
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Registrace – Řízení IT projektů</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../stylesPr/stylesPr.css">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-primary text-white shadow-sm">
  <div class="container py-3 d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-flex align-items-center mb-2 mb-lg-0">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="fs-5 mb-0">
          <a href="../ViewsPr/articles/blog_home.php" class="nav-link text-white px-0">Řízení IT projektů</a>
        </h1>
        <p class="mb-0 small text-light">Technologický blog o projektovém managementu v IT</p>
        <?php if (isset($_SESSION['username'])): ?>
          <p class="mb-0 small text-white mt-1">
            Přihlášen jako: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
          </p>
        <?php endif; ?>
      </div>
    </div>

    <nav class="nav nav-pills flex-row align-items-center gap-2">
      <?php if (isset($_SESSION['username'])): ?>
        <a href="../ViewsPr/articles/create.php" class="btn btn-light btn-sm ms-2">Přidat post</a>
      <?php endif; ?>
      <a href="../ViewsPr/articles/nastenka.php" class="nav-link text-white px-3">Nástěnka</a>
      <a href="../../authPr/login.php" class="nav-link text-white px-3">Odhlaseni</a>
    </nav>
  </div>
</header>

<main class="flex-grow-1 py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Moje příspěvky</h2>

    <?php if (!empty($posts)): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col">
            <div class="card h-100 shadow-sm rounded-4 border-0">
              <div class="card-body">
                <h5 class="card-title text-dark"><?= htmlspecialchars($post['title']) ?></h5>
                <p class="card-text text-secondary">
                  <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 200, '...'))) ?>
                </p>
              </div>
              <div class="card-footer bg-light text-muted rounded-bottom-4">
                <small>Publikováno: <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?></small>
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

  <footer class="text-center py-3 mt-auto border-top">
    <div class="container">
      &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
    </div>
  </footer>

</body>
</html>
