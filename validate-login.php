<?php
$con = mysqli_connect("localhost", "root", "", "users");
if(mysqli_connect_errno()) {
    echo "connection to database failed".mysqli_connect_error();
}
$email = $_POST['email-login'];
$password = $_POST['password-login'];
$query = "SELECT email,password FROM members WHERE email='".$email."' AND password='".$password."'";
$result = mysqli_query($con, $query);
if(!$result){
    echo "Query failed".mysqli_error($con);
    die();
}else{
    if(count($result)==0){
        header("location:customer-register.php?msg=4");
    }else {
        setcookie("test", "test", time()+60*60, "/");
        if(isset($_COOKIE['test'])) {
            setcookie("auth", '$email', time()+60*60*24, "/");
            header("location:index.php");
            mysqli_close($con);
        }else {
            session_start();
            $_SESSION['auth'] = $email;
        }
    }
}
