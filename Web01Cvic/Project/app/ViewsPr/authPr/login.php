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

<header class="bg-primary text-white shadow-sm">
  <div class="container py-3 d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-flex align-items-center mb-2 mb-lg-0">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="fs-5 mb-0"><a href="../articles/blog_home.php" class="text-white text-decoration-none d-inline-block">Řízení IT projektů</a></h1>
        <p class="mb-0 small text-light">Technologický blog o projektovém managementu v IT</p>
      </div>
    </div>
    <nav class="nav nav-pills flex-row">
      <a href="../articles/nastenka.php" class="nav-link text-white px-3">Nástěnka</a>
      <a href="../authPr/register.php" class="nav-link text-white px-3">Registrace</a>
    </nav>
  </div>
</header>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5 auth-bg">
  <div class="container" style="max-width: 480px;">
    <div class="card shadow-sm rounded-4 border-0">
      <div class="card-body px-4 py-5">
        <h2 class="card-title text-center mb-4">Přihlášení uživatele</h2>

        <form action="../../ControllersPr/login.php" method="post" class="d-flex flex-column gap-3">

          <div class="form-group">
            <label for="username" class="form-label">Uživatelské jméno</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Přihlásit se</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>



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
