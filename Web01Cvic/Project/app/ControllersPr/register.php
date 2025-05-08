<?php
require_once '../ModelsPr/Database.php';
require_once '../ModelsPr/User.php';

session_start();

// Připojení k databázi a model
$db = (new Database())->getConnection();
$userModel = new User($db);

// Validace POST dat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($username) || empty($password) || empty($password_confirm)) {
        die('Vyplňte prosím všechna povinná pole.');
    }

    if ($password !== $password_confirm) {
        die('Hesla se neshodují.');
    }

    if ($userModel->existsByUsername($username)) {
        die('Uživatelské jméno je již obsazené.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($userModel->register($username, $email, $password)) {
        header("Location: ../VeiwsPr/authPr/login.php");
        exit();
    } else {
        die('Registrace se nezdařila.');
    }
} else {
    die('Neplatný požadavek.');
}