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
        <p class="mb-0">Registrace nového uživatele</p>
      </div>
    </div>
  </header>

  <!-- Добавляем flex-grow-1 -->
  <main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="container" style="max-width: 500px;">
      <div class="card shadow-sm rounded-4">
        <div class="card-body">
          <h2 class="card-title mb-4 text-center">Vytvořit účet</h2>
          <form id="registrationForm" action="../../ControllersPr/register.php" method="post">

            <div class="mb-3">
              <label for="username" class="form-label">Uživatelské jméno</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Heslo</label>
              <input type="password" class="form-control" id="password" name="password"
                     pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                     title="Min. 8 znaků, 1 velké písmeno a 1 číslo" required>
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Potvrzení hesla</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
                <div id="passwordMatchMessage" class="form-text text-danger d-none">
                    Hesla se neshodují.
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Registrovat se</button>
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
