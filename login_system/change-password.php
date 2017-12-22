<?php
include "check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

//if(!isset($_POST['submit']))
//    header("Location: ../index.php");

$oldPassword = addslashes($_POST['oldPassword']);//OK
$newPassword = addslashes($_POST['newPassword']);//OK
$newPasswordConf = addslashes($_POST['newPasswordConf']);//OK
$error = ''; //OK

if($newPassword != $newPasswordConf) {
    $error = "ERROR_R_PASSWORD_NOMATCH";//OK
} else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,32}$/', $newPassword)) {
    $error = "ERROR_R_PASSWORD_NOTVALID";//OK
}

if(!empty($error)) {
    header("Location: ../customer-account.php?password-change-error=$error");
} else {
    require "db.php";

    $username = '';//OK
    if(isset($_COOKIE['auth']))
        $username = $_COOKIE['auth'];//OK
    else if(isset($_SESSION['auth']))
        $username = $_SESSION['auth'];//OK

    $query="SELECT * FROM users WHERE username='$username' AND password='$oldPassword'";
    $result = mysqli_query($con, $query) OR die(mysqli_error($connection));

    if(mysqli_num_rows($result) != 0) {
        $query = "UPDATE `users` SET `password`='$newPassword' WHERE username='$username' AND password='$oldPassword'";
        $result = mysqli_query($con, $query) OR die(mysqli_error($connection));
        mysqli_close($con);
        header("Location: ../customer-account.php?password-change-msg=successful");
    } else {
        mysqli_close($con);
        header("Location: ../customer-account.php?password-change-error=ERROR_L_INCORRECT_PASSWORD");
    }
}