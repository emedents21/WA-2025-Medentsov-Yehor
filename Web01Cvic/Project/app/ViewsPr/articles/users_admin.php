<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../../ModelsPr/database.php';
require_once __DIR__ . '/../../ModelsPr/user.php';

$db = (new Database())->getConnection();
$userModel = new User($db);

// Smazání uživatele (kromě sebe sam)
if (isset($_GET['delete'])) {
    $userIdToDelete = (int)$_GET['delete'];
    if ($userIdToDelete !== $_SESSION['user_id']) {
        $userModel->delete($userIdToDelete);
        header("Location: users_admin.php?deleted=1");
        exit();
    }
}

$users = $userModel->getAll();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Správa uživatelů – Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

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
                <p class="mb-0 small text-white mt-1">
                    Přihlášen jako: <strong><?= htmlspecialchars($_SESSION['username']) ?> (admin)</strong>
                </p>
            </div>
        </div>
        <nav class="nav nav-pills flex-row gap-3 align-items-center">
            <a href="create.php" class="nav-link bg-white text-primary fw-semibold px-3 rounded">Přidat post</a>
            <a href="edit_delete.php" class="nav-link bg-white text-primary fw-semibold px-3 rounded">Editace příspěvků</a>
            <a href="../../ControllersPr/logout.php" class="nav-link text-white px-3">Odhlásit se</a>
        </nav>
    </div>
</header>

<main class="flex-grow-1 py-5">
    <div class="container">
        <h2 class="mb-4 text-center text-dark fw-semibold">Správa uživatelů</h2>
        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert">
                Uživatel byl úspěšně smazán.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body px-4 py-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Jméno</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Akce</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($u['id']) ?></td>
                                            <td><?= htmlspecialchars($u['username']) ?></td>
                                            <td><?= htmlspecialchars($u['email']) ?></td>
                                            <td>
                                                <span class="badge <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
                                                    <?= htmlspecialchars($u['role']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('Opravdu chcete smazat tohoto uživatele?');">
                                                        Smazat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">Nelze smazat sám sebe</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="text-center py-4 mt-auto bg-dark text-white rounded-top-4">
    <div class="container small">
        &copy; 2025 Yehor Medentsov – Blog o řízení IT projektů
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
