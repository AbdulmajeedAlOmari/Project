<?php

session_start();

if(!isset($_COOKIE['auth']) && !isset($_SESSION['auth']))
    header("Location: ../customer-register.php?error=ERROR_NOT_LOGGED_IN");

if(isset($_COOKIE['auth'])) {
    unset($_COOKIE['auth']);
    setcookie('auth', null, -1 , '/');
} else if(isset($_SESSION['auth'])) {
    session_unset();
    session_destroy();
}

header("Location: ../index.php?logout=". rand());