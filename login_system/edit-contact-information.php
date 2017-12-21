<?php
    require "db.php";
    if(isset($_COOKIE['auth'])) {
        $username = $_COOKIE['auth'];
    }else {
        $username = $_SESSION['auth'];
    }
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $query="UPDATE `users` SET `firstName`='$fname',`lastName`='$lname',`phoneNumber`='$phone',`street`='$street',`zip`='$zip',`state`='$state',`country`='$country' WHERE username='$username'";
    if (!mysqli_query($con, $query)) {
        mysqli_close($con);
        die("Query Failed : " . mysqli_error($con));
    } else {
        mysqli_close($con);
        header("Location: ../customer-account.php?contactinfo-msg=successful");
    }
