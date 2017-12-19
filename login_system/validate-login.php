<?php
require "db.php";

//TODO prevent multi-login "https://stackoverflow.com/questions/4614052/how-to-prevent-multiple-form-submission-on-multiple-clicks-in-php"

if(isset($_COOKIE['formSubmitted']) || isset($_SESSION['formSubmitted']))
    die('You can not submit multiple times');

setcookie('formSubmitted', 'true', time()+1800, '/');

if(!isset($_COOKIE['formSubmitted'])) {
    session_start();
    $_SESSION['formSubmitted'] = 'true';
}

//To prevent sql injecting
$email = addslashes($_POST['email-login']);
$password = addslashes($_POST['password-login']);

$query = "SELECT username,password,email FROM Users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error : " . mysqli_error($con));
} else {
    if (count($result) == 0) {

        if(isset($_COOKIE['formSubmitted']))
            setcookie('formSubmitted', '', time() - 3600);
        else
            unset($_SESSION['formSubmitted']);

        header("location:customer-register.php?login-error=ERROR_L_INCORRECT");
    } else {
        $user = mysqli_fetch_assoc($results);
        $username = $user['username'];

        setcookie("auth", $username, time() + 60 * 60 * 24, "/");
        if (isset($_COOKIE['auth'])) {
            setcookie('formSubmitted', '', time() - 3600); //Remove formSubmission Status
        } else {
            unset($_SESSION['formSubmitted']);
            $_SESSION['auth'] = $username;
        }

        header("location:index.php");
    }
}
