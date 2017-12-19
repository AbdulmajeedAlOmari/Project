<?php
require "db.php";
require "../utility/is_email.php";

//TODO prevent multi-registration "https://stackoverflow.com/questions/4614052/how-to-prevent-multiple-form-submission-on-multiple-clicks-in-php"

$email = addslashes($_POST['email']);
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
$confirmPassword = addslashes($_POST['passwordconfirmation']); //TODO check the addSlashes() method effect in condition

$result = mysqli_query($con, "SELECT * FROM Users");
$error = '';

//These are new conditions

if(!preg_match('/^[a-zA-Z0-9]{4,32}$/', $username)) {
    $error = "ERROR_R_USERNAME_NOTVALID";
} else if(!is_email($email)) {
    $error = "ERROR_R_EMAIL_NOTVALID";
} else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,32}$/', stripslashes($password))) {
    $error = "ERROR_R_PASSWORD_NOTVALID";
} else if($password != $confirmPassword) {
    $error = "ERROR_R_PASSWORD_NOMATCH";
} else {
    while($row=mysqli_fetch_array($result) && empty($error)) {
        $u = $row['username'];
        $e = $row['email'];
        if($u == $username){
            $error = "ERROR_R_USERNAME_EXIST";
        }else if($e == $email) {
            $error = "ERROR_R_EMAIL_EXIST";
        }
    }
}


if (!empty($error)) {
    mysqli_close($con);
    header("location: customer-register.php?register-error=$error");
//    die();
}

//TODO check database
$query = "INSERT INTO `Users`(`username`, `password`, `email`) VALUES ('$username', '$password', '$email')";

if (!mysqli_query($con, $query)) {
    mysqli_close($con);
    die("Query Failed : " . mysqli_error($con));
} else {
    mysqli_close($con);
    header("location: customer-register.php?register-msg=successful");
}