<?php
require "db.php";
require "check-login.php";
$itemId = $_GET['itemId'];
if(!isLoggedIn()){
    header("location:../shop-detail.php?itemId=$itemId&error=ERROR_NOT_LOGGED_IN");
}
if(isset($_COOKIE['auth'])) {
    $username = $_COOKIE['auth'];
}else {
    $username = $_SESSION['auth'];
}
$query = "SELECT id FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$id = $row['id'];


$query = "INSERT INTO `wishlist`(`id`, `itemId`) VALUES ('$id','$itemId')";
if (!mysqli_query($con, $query)) {
    mysqli_close($con);
    die("Query Failed : " . mysqli_error($con));
} else {
    mysqli_close($con);
    header("Location: ../shop-detail.php?itemId=".$itemId."&wishlist-msg=successful");
}