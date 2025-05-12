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

<header class="d-flex align-items-center py-3 border-bottom">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="mb-0 fs-4">Řízení IT projektů</h1>
        <p class="mb-0 text-muted">Technologický blog o projektovém managementu v IT</p>
      </div>
    </div>
    <a href="../authPr/register.php" class="btn btn-primary">Registrace</a>
    <a href="../authPr/login.php" class="btn btn-primary">Přihlášení</a>
  </div>
</header>

<main class="flex-grow-1 py-5">
    <div class="container">
        <h2 class="mb-4">Nástěnka – veřejné příspěvky</h2>
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
                                <small>
                                    Autor: <?= htmlspecialchars($post['username']) ?><br>
                                    Publikováno: <?= htmlspecialchars(date('d.m.Y H:i', strtotime($post['created_at']))) ?>
                                </small>
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



<footer class="text-center py-3 border-top">
  <div class="container">
    &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
  </div>
</footer>

</body>
</html>
