<?php //TODO add implementation : "https://stackoverflow.com/questions/26757659/how-to-store-images-in-mysql-database-using-php"
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
$itemName = $_POST['itemName'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if(isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["imageUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $image = basename($_FILES["imageUpload"]["name"], ".jpg"); // used to store the filename in a variable
}

$query = "INSERT INTO `items`(`sellerId`, `category`, `description`, `image`, `name`, `price`, `quantity`) VALUES ('$sellerId','$category','$description','$image','$itemName','$price','$quantity')";
if (!mysqli_query($con, $query)) {
    mysqli_close($con);
    die("Query Failed : " . mysqli_error($con));
} else {
    mysqli_close($con);
    header("Location: ../new-order.php?neworder-msg=successful");
}