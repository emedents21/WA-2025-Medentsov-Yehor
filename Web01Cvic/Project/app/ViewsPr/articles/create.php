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
  <title>Registrace – Řízení IT projektů</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../stylesPr/stylesPr.css">
</head>
<body class="d-flex flex-column min-vh-100">

  <header class="d-flex align-items-center py-3 border-bottom mb-4">
    <div class="container d-flex align-items-center">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="mb-0">Řízení IT projektů</h1>
        <p class="mb-0">Příspěvky</p>
      </div>
    </div>
  </header>

<div class="container mt-4">
    <h2>Vytvořit nový příspěvek</h2>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="../../ControllersPr/PostController.php">
        <div class="mb-3">
            <label for="title" class="form-label">Název</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Obsah</label>
            <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Publikovat</button>
    </form>
</div>

  <footer class="text-center py-3 mt-auto border-top">
    <div class="container">
      &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
    </div>
  </footer>

<!-- Kontrola hesel v JS -->
<script>
    const form = document.getElementById('registrationForm');
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirm');
    const message = document.getElementById('passwordMatchMessage');

    form.addEventListener('submit', function (e) {
        if (password.value !== confirm.value) {
            e.preventDefault();
            message.classList.remove('d-none');
        } else {
            message.classList.add('d-none');
        }
    });
</script>

</body>
</html>
