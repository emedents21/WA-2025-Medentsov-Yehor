<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Přidat příspěvek – Řízení IT projektů</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<!-- Header -->
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
      <a href="nastenka.php" class="nav-link text-white px-3">Nástěnka</a>
      <a href="../../authPr/login.php" class="nav-link text-white px-3">Odhlásit se</a>
    </nav>
  </div>
</header>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
  <div class="container" style="max-width: 560px;">
    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-body px-4 py-5">
        <h2 class="card-title text-center mb-4 fw-semibold">Vytvořit nový příspěvek</h2>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="../../ControllersPr/PostController.php" class="d-flex flex-column gap-4">
          <div>
            <label for="title" class="form-label fw-medium">Název</label>
            <input type="text" class="form-control rounded-3" name="title" id="title" required>
          </div>
          <div>
            <label for="content" class="form-label fw-medium">Obsah</label>
            <textarea class="form-control rounded-3" name="content" id="content" rows="6" required></textarea>
          </div>
          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary btn-lg rounded-3">Publikovat</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<footer class="text-center py-4 mt-auto bg-dark text-white rounded-top-4">
  <div class="container small">
    &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
  </div>
</footer>

</body>
</html>
