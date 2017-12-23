<?php
    include "check-login.php";
    if(!isLoggedIn())
        header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

    if(!isset($_POST['submit']))
        header("Location: ../index.php");

    require "db.php";

    if(isset($_COOKIE['auth'])) {
        $username = $_COOKIE['auth'];
    }else {
        $username = $_SESSION['auth'];
    }
    $fname = addslashes($_POST['firstname']);
    $lname = addslashes($_POST['lastname']);
    $street = addslashes($_POST['street']);
    $zip = addslashes($_POST['zip']);
    $state = addslashes($_POST['state']);
    $country = addslashes($_POST['country']);
    $phone = addslashes($_POST['phone']);

    if(!is_numeric($zip) || intval($zip) < 0 || strlen($zip) > 7)
        header("Location: ../customer-account.php?error=ERROR_ZIP_NOT_NUMBER");
    else if(!is_numeric($phone) || intval($phone) < 0 || strlen($phone) > 15)
        header("Location: ../customer-account.php?error=ERROR_PHONE_NOT_NUMBER");

    $query="UPDATE `users` SET `firstName`='$fname',`lastName`='$lname',`phoneNumber`='$phone',`street`='$street',`zip`='$zip',`state`='$state',`country`='$country' WHERE username='$username'";
    if (!mysqli_query($con, $query)) {
        mysqli_close($con);
        die("Query Failed : " . mysqli_error($con));
    } else {
        mysqli_close($con);
        header("Location: ../customer-account.php?contactinfo-msg=successful");
    }
