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

$query = "SELECT id FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));

$row = mysqli_fetch_assoc($result);
$sellerId = $row['id'];

$category = $_POST['category'];

$itemName = addslashes($_POST['itemName']);
$description = addslashes($_POST['description']);
$price = addslashes($_POST['price']);
$quantity = addslashes($_POST['quantity']);

if(!is_numeric($price) || intval($price) < 0 || strlen($price) > 11)
    header("Location: ../customer-sell.php?error=ERROR_PRICE_NOT_A_NUMBER");

if(!is_numeric($quantity) || intval($quantity) < 0 || strlen($quantity) > 11)
    header("Location: ../customer-sell.php?error=ERROR_QUANTITY_NOT_A_NUMBER");

$uploadOk = 0;

if(isset($_POST["submit"])) {
    if(isset($_FILES['fileToUpload']['name'])) {
        $target_dir = "uploads/";
        $prefix = rand();
        $target_file = $target_dir . $prefix . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(empty($_FILES['fileToUpload']['tmp_name']))
            header("Location: ../customer-sell.php?error=ERROR_NOT_UPLOADED");

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $error = '';
        if ($check === false) {
            $error = "ERROR_NOT_AN_IMAGE";
        } else if(file_exists($target_file)) {
            $error = "ERROR_CHANGE_IMAGE_NAME";
        } else if ($_FILES["fileToUpload"]["size"] > 500000) {
            $error = "ERROR_IMAGE_TOO_LARGE";
        } else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = "ERROR_IMAGE_TYPE";
        }

        if(!empty($error))
            header("Loaction: ../customer-sell.php?error=$error");

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $uploadOk = 1;
        }

        $image = $prefix.basename($_FILES["fileToUpload"]["name"]); // used to store the filename in a variable
    }
}

if($uploadOk == 1) {
    $query = "INSERT INTO `items`(`sellerId`, `category`, `description`, `image`, `itemName`, `price`, `quantity`) VALUES ('$sellerId','$category','$description','$image','$itemName','$price','$quantity')";
    if (!mysqli_query($con, $query)) {
        mysqli_close($con);
        die("Query Failed : " . mysqli_error($con));
    } else {
        $lastId = mysqli_insert_id($con);
        $query = "SELECT id FROM users WHERE interest='$category'";
        $result = mysqli_query($con,$query) OR die(mysqli_error($con));
        while($row=mysqli_fetch_array($result)){
            $recepientId=$row['id'];
            $query = "INSERT INTO `notifications`(`recepientId`, `itemId`) VALUES ('$recepientId','$lastId')";
            $result = mysqli_query($con,$query) OR die(mysqli_error($con));
        }
        mysqli_close($con);
        header("Location: ../customer-sell.php?msg=successful");
    }
} else {
    header("Location: ../customer-sell.php?error=ERROR_COULD_NOT_UPLOAD");
}