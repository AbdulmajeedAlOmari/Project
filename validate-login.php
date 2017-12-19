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
        header("location:customer-register.php?login-error=ERROR_L_INCORRECT");
    } else {
        $user = mysqli_fetch_assoc(); //TODO check this
//        console.log("Fetched Database!");
        if(stripslashes($password) == $user['password']) { //TODO edit this condition if possible
//            console.log("Condition Correct!");
            setcookie("auth", $email, time() + 60 * 60 * 24, "/");
            if (isset($_COOKIE['auth'])) {
//                console.log("Cookie Made!");
                header("location:index.php");
            } else {
                session_start();
//                console.log("Session Made!");
                $_SESSION['auth'] = $email;
            }
        } else {
//            console.log("Condition Failed!");
            header("location:customer-register.php?login-error=ERROR_L_INCORRECT");
        }
    }
}
