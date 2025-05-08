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
        <p class="mb-0">Přihlášení uživatele</p>
      </div>
    </div>
  </header>

 <main class="flex-grow-1 d-flex align-items-center justify-content-center">
  <div class="container" style="max-width: 500px;">
    <div class="card shadow-sm rounded-4">
      <div class="card-body p-4">
        <h2 class="card-title mb-4 text-center">Přihlášení uživatele</h2>
        <form action="../../ControllersPr/login.php" method="post" class="d-flex flex-column gap-3">

          <div>
            <label for="username" class="form-label">Uživatelské jméno</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>

          <div>
            <label for="password" class="form-label">Heslo</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <div class="d-grid mt-2">
            <button type="submit" class="btn btn-success btn-lg">Přihlásit se</button>
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
