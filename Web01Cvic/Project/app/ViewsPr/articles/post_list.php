<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Registrace – Řízení IT projektů</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../stylesPr/stylesPr.css">
</head>
<body class="d-flex flex-column min-vh-100">

  <header class="d-flex align-items-center py-3 border-bottom mb-4">
    <div class="container d-flex align-items-center">
      <div class="logo-placeholder me-3">Logo</div>
      <div>
        <h1 class="mb-0">Řízení IT projektů</h1>
        <?php if (isset($_SESSION['username'])): ?>
          <span class="nav-link text-white">Přihlášen jako: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
        <?php endif; ?>
        <p class="mb-0">Přihlášení uživatele</p>
        <a href="../ViewsPr/articles/create.php" class="btn btn-primary">Pridat post</a>

      </div>
    </div>
  </header>

  <main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="container">
      <?php  
        echo 'Session ID: ' . session_id();
        session_regenerate_id(true);
        echo 'New Session ID: ' . session_id();
      ?>
      <h2>Výpis postu</h2>
      <?php if(!empty($posts)): ?>
        <!-- <h3>Hrubý výpis knih</h3> -->
        <?php // var_dump($books); ?>
        <!-- <h3>Lepší výpis knih</h3> -->
        <pre><?php // print_r($books); ?></pre>
        <h3>Tabulkový výpis postu</h3>
        <table class="table table-bordered table-hover">
          <thead class="table-primary">
            <tr>
              <th>Název</th>
              <th>Obsah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($posts as $post): ?>
              <tr>
                <td><?= htmlspecialchars($post['title']) ?></td>
                <td><?= htmlspecialchars($post['content']) ?></td>
              </tr>    
            <?php endforeach; ?>    
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-info">Žádny post nebyl nalezena</div>
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