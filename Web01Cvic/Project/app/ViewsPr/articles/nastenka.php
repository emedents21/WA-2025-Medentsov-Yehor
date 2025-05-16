<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../ControllersPr/PostController.php';

$controller = new PostController();
$posts = $controller->getPublicPosts();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nástěnka – Řízení IT projektů</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../stylesPr/stylesPr.css" />
</head>
<body>

<header class="bg-primary text-white shadow-sm">
  <div class="container py-3 d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-flex align-items-center mb-2 mb-lg-0">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="fs-5 mb-0"><a href="blog_home.php" class="text-white text-decoration-none d-inline-block">Řízení IT projektů</a></h1>
        <p class="mb-0 small text-light">Technologický blog o projektovém managementu v IT</p>
      </div>
    </div>
    <nav class="nav nav-pills flex-row">
      <a href="../authPr/register.php" class="nav-link text-white px-3">Registrace</a>
      <a href="../authPr/login.php" class="nav-link text-white px-3">Přihlášení</a>
    </nav>
  </div>
</header>

<main class="flex-grow-1 py-5 bg-light">
  <div class="container">
    <h2 class="mb-5 text-center text-dark">Nástěnka – veřejné příspěvky</h2>
    <?php if (!empty($posts)): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title text-dark"><?= htmlspecialchars($post['title']) ?></h5>
                <p class="card-text text-secondary">
                  <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 200, '...'))) ?>
                </p>
              </div>
              <div class="card-footer bg-white border-0 text-end">
                <small class="text-muted d-block">👤 <?= htmlspecialchars($post['username']) ?></small>
                <small class="text-muted">🕒 <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?></small>
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
