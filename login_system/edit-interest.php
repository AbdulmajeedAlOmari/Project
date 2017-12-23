<?php
require "db.php";
include "check-login.php";

if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

if(isset($_COOKIE['auth'])) {
    $username = $_COOKIE['auth'];
} else {
    $username = $_SESSION['auth'];
}
$category = $_POST['category'];
$query = "UPDATE `users` SET `interest`='$category' WHERE username='$username'";
$result = mysqli_query($con,$query) OR die(mysqli_error($con));
header("location:../customer-notifications.php?msg=successful");