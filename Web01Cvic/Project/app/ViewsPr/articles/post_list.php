<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../ControllersPr/PostController.php';

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $controller = new PostController();
    $posts = $controller->getUserPosts($userId);
} else {
    $posts = [];
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Moje příspěvky – Řízení IT projektů</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../styles.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<header class="bg-primary text-white shadow-sm mb-4">
  <div class="container py-3 d-flex flex-wrap align-items-center justify-content-between rounded-4">
    <div class="d-flex align-items-center mb-2 mb-lg-0 gap-3">
      <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" style="width:46px; height:46px;">
            <img src="../../imagess/Logo.svg">     
    </div>
      <div>
        <h1 class="fs-4 mb-1 fw-bold text-white">
          <a href="blog_home.php" class="text-white text-decoration-none d-inline-block">Řízení IT projektů</a>
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
        <a href="create.php" class="nav-link bg-white text-primary fw-semibold px-3 rounded">Přidat post</a>
        <a href="edit_delete.php" class="nav-link bg-white text-primary fw-semibold px-3 rounded">Editace přispěvků</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="users_admin.php" class="nav-link bg-white text-danger fw-semibold px-3 rounded">Správa uživatelů</a>
        <?php endif; ?>
        <a href="../../ControllersPr/logout.php" class="nav-link text-white px-3">Odhlásit se</a> 
      </nav>

  </div>
</header>

<main class="flex-grow-1 py-5">
  <div class="container">
    <h2 class="mb-5 text-center text-dark fw-semibold">Moje příspěvky</h2>
    <?php if (!empty($posts)): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col">
            <div class="card h-100 shadow-sm border-0 rounded-4">
              <div class="card-body px-4 py-3">
                <h5 class="card-title mb-2 text-dark"><?= htmlspecialchars($post['title']) ?></h5>
                <p class="card-text mb-3 text-secondary">
                  <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 220, '...'))) ?>
                </p>
              </div>
              <div class="card-footer bg-white border-0 rounded-bottom-4 text-end">
                <div class="small text-muted">
                  Publikováno: <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?>
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
