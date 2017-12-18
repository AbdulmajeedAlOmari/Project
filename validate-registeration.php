<?php
   $con = mysqli_connect("localhost","root","","users");
      if (mysqli_connect_errno()){
       echo "Failed to connecct to database".mysqli_connect_error();
      }
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($con, "SELECT * FROM members");
    $duplicate = 0;
    while($row = mysqli_fetch_array($result)) {
      $u = $row['username'];
      $e = $row['email'];
      if($u == $username){
          $duplicate = 1;
      }else if($e == $email) {
          $duplicate = 2;
      }
   }
   if ($duplicate == 1) {
       header("location: customer-register.php?msg=2");
       die();
   }elseif($duplicate == 2) {
       header("location: customer-register.php?msg=3");
       die();
   }
   $query = "INSERT INTO `members`(`email`, `username`, `password`) VALUES ('$email', '$username', '$password')";
   if (!mysqli_query($con, $query)) {
       echo "Error" .mysqli_error($con);
   }else {
       mysqli_close($con);
       header("location: customer-register.php?msg=1");
   }
   ?>