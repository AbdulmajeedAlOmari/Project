<?php
include "check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

require "db.php";

if(isset($_COOKIE['auth'])) {
    $username = $_COOKIE['auth'];
}else {
    $username = $_SESSION['auth'];
}


if(!isset($_GET['itemId']) || !isset($_GET['userId']))
    header("Location: ../my-items.php?error=ERROR_MODIFY_REJECT");

$query = "SELECT id FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));

$row = mysqli_fetch_assoc($result);
$sellerId = $row['id'];

$itemId = $_GET['itemId'];
$userId = $_GET['userId'];

if($sellerId != $_GET['userId'])
    header("Location: ../my-items.php?error=ERROR_MODIFY_REJECT");

$category = $_POST['category'];
$itemName = $_POST['itemName'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if(!isset($itemName) || !isset($description) || !isset($price) || !isset($quantity)||
    trim($itemName) == '' || trim($description) == '' || trim($price) == '' || trim($quantity) == '')
    header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&error=ERROR_NOT_FULLY_FILLED");

if(!is_numeric($price))
    header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&error=ERROR_PRICE_NOT_A_NUMBER");

if(!is_numeric($quantity))
    header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&error=ERROR_QUANTITY_NOT_A_VALID_NUMBER");

$uploadOk = 0;

if(isset($_POST["submit"])) {
    if(isset($_FILES['fileToUpload']['name'])) {
        $target_dir = "uploads/";
        $prefix = rand();
        $target_file = $target_dir . $prefix . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(!empty($_FILES['fileToUpload']['tmp_name'])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $error = '';
            if ($check === false) {
                $error = "ERROR_NOT_AN_IMAGE";
            } else if ($_FILES["fileToUpload"]["size"] > 500000) {
                $error = "ERROR_IMAGE_TOO_LARGE";
            } else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $error = "ERROR_IMAGE_TYPE";
            }

            if(empty($error)) {
                $query = "SELECT image FROM items WHERE itemId='$itemId' AND sellerId='$sellerId'";
                $result = mysqli_query($con, $query) OR die(mysqli_error($con));
                $row = mysqli_fetch_array($result);
                unlink("uploads/".$row['image']);
            }

            if(file_exists($target_file)) {
                $error = "ERROR_CHANGE_IMAGE_NAME";
            }

            if(!empty($error)) {
                header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&error=$error");
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $uploadOk = 1;
            }

            $image = $prefix.basename($_FILES["fileToUpload"]["name"]); // used to store the filename in a variable
        }

    }
}


if($uploadOk == 1) {


    $query = "UPDATE `items` SET `category`='$category',`description`='$description',`itemName`='$itemName',`image`='$image',`price`='$price',`quantity`='$quantity' WHERE itemId='$itemId' AND sellerId='$userId'";
    $result =  mysqli_query($con, $query) OR die(mysqli_error($con));
    mysqli_close($con);
    header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&msg=successful");
} else {
    $query = "UPDATE `items` SET `category`='$category',`description`='$description',`itemName`='$itemName',`price`='$price',`quantity`='$quantity' WHERE itemId='$itemId' AND sellerId='$userId'";
    $result =  mysqli_query($con, $query) OR die(mysqli_error($con));
    mysqli_close($con);
    header("Location: ../modify-item.php?itemId=$itemId&userId=$userId&msg=successful");
}