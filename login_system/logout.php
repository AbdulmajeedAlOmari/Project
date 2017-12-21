<?php

session_start();

if(isset($_COOKIE['auth'])) {
    unset($_COOKIE['auth']);
    setcookie('auth', null, -1 , '/');
} else if(isset($_SESSION['auth'])) {
    session_unset();
    session_destroy();
}

header("Location: ../index.php?logout=". rand());