<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    session_start();
    session_unset();     // smaže všechny session proměnné
    session_destroy();   // zničí session

    header("Location: ../ViewsPr/articles/blog_home.php");
    exit();
