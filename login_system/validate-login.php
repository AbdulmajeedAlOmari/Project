<?php
require "db.php";

//if(session_status() != 2)
    session_start();

//To prevent sql injecting
$email = addslashes($_POST['email-login']);
$password = addslashes($_POST['password-login']);

$query = "SELECT username,password,email FROM Users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));

if (mysqli_num_rows($result) == 0) {
    header("Location: ../customer-register.php?login-error=ERROR_L_INCORRECT");
} else {
    $user = mysqli_fetch_assoc($result);
    $username = $user['username'];

    setcookie("auth", stripslashes($username), time() + 60 * 60 * 24, "/");

    if(!isset($_COOKIE['auth']))
        $_SESSION['auth'] = stripslashes($username);

    header("location: ../index.php?" . uniqid());
}
