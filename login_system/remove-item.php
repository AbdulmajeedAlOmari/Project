<?php
require "check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

if(isset($_COOKIE['auth']))
    $username = $_COOKIE['auth'];
else
    $username = $_SESSION['auth'];

require "db.php";

if(isset($_GET['itemId']) && isset($_GET['userId'])) {
    $itemId = $_GET['itemId'];
    $userId = $_GET['userId'];

    $query = "SELECT itemId,sellerId,image FROM items WHERE itemId='$itemId' AND sellerId='$userId'";
    $result = mysqli_query($con, $query) OR die(mysqli_error($con));

    $row = mysqli_fetch_array($result);
    $image = $row['image'];

    if(mysqli_num_rows($result) != 0) {

        $query = "SELECT id FROM users WHERE username='$username'";
        $result = mysqli_query($con,$query) OR die(mysqli_error($con));

        $row = mysqli_fetch_array($result);

        unset($_GET['itemId']);
        unset($_GET['userId']);

        if($row['id'] == $userId) {
            $query = "DELETE FROM items WHERE itemId='$itemId'";
            $result = mysqli_query($con, $query) OR die(mysqli_error($con));
            unlink("uploads/".$image);
            header("Location: ../my-items.php?msg=successful");
        } else {
            header("Location: ../my-items.php?error=ERROR_REMOVE_OTHERS_ITEM");
        }
    } else {
        header("Location: ../my-items.php?error=ERROR_REMOVE");
    }

} else {
    header("Location: ../my-items.php?error=ERROR_REMOVE");
}

