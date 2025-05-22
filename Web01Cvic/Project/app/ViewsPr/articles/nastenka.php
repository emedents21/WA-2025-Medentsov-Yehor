<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../ControllersPr/PostController.php';
if (session_status() === PHP_SESSION_NONE) session_start();

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
        </div>
      </div>
      <nav class="nav nav-pills flex-row gap-2">
          <?php if (isset($_SESSION['user_id'])): ?>
           <a href="post_list.php" class="nav-link text-white px-3">Moje příspěvky</a>
          <a href="../../ControllersPr/logout.php" class="nav-link text-white px-3">Odhlásit se</a>
          <?php else: ?>
        <a href="../authPr/register.php" class="nav-link text-white px-3">Registrace</a>
        <a href="../authPr/login.php" class="nav-link text-white px-3">Přihlášení</a>
          <?php endif; ?>
      </nav>
    </div>
  </header>

  <main class="flex-grow-1 py-5">
  <div class="container">
   <h2 class="mb-5 text-center text-dark fw-semibold">Nástěnka - veřejné příspěvky</h2>
    <?php if (!empty($posts)): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col">
            <div class="card h-100 shadow-sm border-0 rounded-4">
              <div class="card-body px-4 py-3">
                <h5 class="card-title mb-2 text-dark"><?= htmlspecialchars($post['title']) ?></h5>
                <?php if (mb_strlen($post['content']) > 220): ?>
                  <!-- Сокращённый текст + ссылка развернуть -->
                  <p class="card-text mb-3 text-secondary" id="short-<?= $post['id'] ?>">
                    <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 220, '...'))) ?>
                    <a href="#" onclick="togglePost(<?= $post['id'] ?>); return false;" class="ms-2 text-primary">Zobrazit více</a>
                  </p>
                  <!-- Полный текст + ссылка свернуть -->
                  <p class="card-text mb-3 text-secondary" id="full-<?= $post['id'] ?>" style="display:none;">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                    <a href="#" onclick="togglePost(<?= $post['id'] ?>); return false;" class="ms-2 text-primary">Skrýt</a>
                  </p>
                <?php else: ?>
                  <p class="card-text mb-3 text-secondary">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                  </p>
                <?php endif; ?>
              </div>
              <div class="card-footer bg-white border-0 rounded-bottom-4 text-end">
                <div class="small mb-1 text-primary fw-medium">
                  <?= htmlspecialchars($post['username']) ?>
                </div>
                <div class="small text-muted">
                  <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?>
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

  <script>
    function togglePost(id) {
      const shortText = document.getElementById('short-' + id);
      const fullText = document.getElementById('full-' + id);
      if (shortText.style.display !== 'none') {
        shortText.style.display = 'none';
        fullText.style.display = '';
      } else {
        shortText.style.display = '';
        fullText.style.display = 'none';
      }
    }
  </script>

</body>
</html>
