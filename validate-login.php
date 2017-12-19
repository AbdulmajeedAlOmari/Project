<?php
require "db.php";

//To prevent sql injecting
$email = addslashes($_POST['email-login']);
$password = addslashes($_POST['password-login']);

$query = "SELECT username,password,email FROM Users WHERE email='" . $email . "'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error : " . mysqli_error($con));
} else {
    if (count($result) == 0) {
        header("location:customer-register.php?msg=4");
    } else {
        $user = mysqli_fetch_assoc();

        if($password == $user['password']) {
            setcookie("auth", $email, time() + 60 * 60 * 24, "/");
            if (isset($_COOKIE['auth'])) {
                header("location:index.php");
            } else {
                session_start();
                $_SESSION['auth'] = $email;
            }
        } else {
            header("location:customer-register.php?login-error=ERROR_L_INCORRECT");
        }
    }
}
