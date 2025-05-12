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
      <a href="../authPr/login.php" class="nav-link text-white px-3">Přihlášení</a>
    </nav>
  </div>
</header>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
  <div class="container" style="max-width: 480px;">
    <div class="card shadow-sm rounded-4 border-0">
      <div class="card-body px-4 py-5">
        <h2 class="card-title text-center mb-4">Vytvořit účet</h2>

        <form id="registrationForm" action="../../ControllersPr/register.php" method="post" class="d-flex flex-column gap-3">

          <div class="form-group">
            <label for="username" class="form-label">Uživatelské jméno</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password"
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                   title="Min. 8 znaků, 1 velké písmeno a 1 číslo" required>
          </div>

          <div class="form-group">
            <label for="password_confirm" class="form-label">Potvrzení hesla</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
            <div id="passwordMatchMessage" class="form-text text-danger d-none">
              Hesla se neshodují.
            </div>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Registrovat se</button>
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
