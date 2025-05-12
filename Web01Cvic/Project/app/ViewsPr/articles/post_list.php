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

  <header class="d-flex align-items-center py-3 border-bottom mb-4">
    <div class="container d-flex align-items-center">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="mb-0">Řízení IT projektů</h1>
        <?php if (isset($_SESSION['username'])): ?>
          <span class="nav-link text-white">Přihlášen jako: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
        <?php endif; ?>
        <p class="mb-0">Přihlášení uživatele</p>
        <a href="../ViewsPr/articles/create.php" class="btn btn-primary">Pridat post</a>

      </div>
    </div>
  </header>

  <main class="flex-grow-1 d-flex align-items-center justify-content-center">
   <div class="container">
    <h2 class="mb-4">Moje příspěvky</h2>

    <?php if (!empty($posts)): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                <p class="card-text"><?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 200, '...'))) ?></p>
              </div>
              <div class="card-footer text-muted">
                Publikováno: <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info">Žádný příspěvek zatím nebyl přidán.</div>
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
