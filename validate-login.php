<?php
require "db.php";

//To prevent sql injecting
$email = addslashes($_POST['email-login']);
$password = addslashes($_POST['password-login']);

$query = "SELECT username,pass,email FROM members WHERE email='" . $email . "'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error : " . mysqli_error($con));
} else {
    if (count($result) == 0) {
        header("location:customer-register.php?msg=4");
    } else {
        setcookie("test", "", time() + 120, "/");
        if (isset($_COOKIE['test'])) {
            setcookie("auth", '$email', time() + 60 * 60 * 24, "/");
            header("location:index.php");
        } else {
            session_start();
            $_SESSION['auth'] = $email;
        }
    }
}
