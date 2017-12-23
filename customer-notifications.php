<?php
require "login_system/db.php";
include "login_system/check-login.php";

if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

if(isset($_COOKIE['auth'])) {
    $username = $_COOKIE['auth'];
} else {
    $username = $_SESSION['auth'];
}
$query = "SELECT id,interest FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));
$userRow = mysqli_fetch_array($result);
$userId = $userRow['id'];
if($userRow['interest'] != "None"){
    $category=$userRow['interest'];
    $query = "SELECT items.itemId, items.itemName, items.image, items.quantity, items.price FROM items,notifications WHERE notifications.recepientId='$userId' AND items.itemId=notifications.itemId";
    $result = mysqli_query($con, $query) OR die(mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Universal - All In 1 Template</title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/eshop-icon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
</head>

<body>


<div id="all">
    <?php include "header.php"; ?>

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>My Items</h1>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>My Items</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="container">

            <div class="row">
                <div class="col-md-9 clearfix" id="basket">
                    <?php
                    if(isset($_GET['msg'])) {
                        if($_GET['msg'] == "successful")
                            echo "<div class=\"alert alert-success\" role=\"alert\">Interest has been updated successfully!</div>";
                        unset($_GET['msg']);
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <form name="notificationsForm" method="post" action="login_system/edit-interest.php">
                                    <div class="form-group">
                                        <label for="category">What are you interested in? </label>
                                        <select name="category">
                                            <option <?php if($category=="Cars") echo "selected";?>>Cars</option>
                                            <option <?php if($category=="Furniture") echo "selected";?>>Furniture</option>
                                            <option <?php if($category=="Plants") echo "selected";?>>Plants</option>
                                            <option <?php if($category=="Animals") echo "selected";?>>Animals</option>
                                        </select>
                                        <button type="submit" name="submit" class="btn btn-template-main"><i class="fa fa-cart-plus"></i>CONFIRM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">

                        <form method="post" action="shop-checkout1.html">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Item</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if($userRow['interest']=="None" && mysqli_num_rows($result) == 0) {
                                        echo "<h3>No notifications to display.</h3>";
                                    } else {
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                            echo "<td>";
                                            echo "<a href=\"shop-detail.php?itemId=".$row['itemId']."\">";
                                            echo "<img src=\"login_system/uploads/".$row['image']."\">";
                                            echo "</a>";
                                            echo "</td>";
                                            /* END image */

                                            echo "<td><a href=\"shop-detail.php?itemId=".$row['itemId']."\">".$row['itemName']."</a></td>";
                                            echo "<td>". $row['quantity']."</td>";
                                            echo "<td>$". $row['price'] ."</td>";

                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <!--                                    <tfoot>-->
                                    <!--                                    <tr>-->
                                    <!--                                        <th colspan="5">Total</th>-->
                                    <!--                                        <th colspan="2">$446.00</th>-->
                                    <!--                                    </tr>-->
                                    <!--                                    </tfoot>-->
                                </table>

                            </div>
                            <!-- /.table-responsive -->
                        </form>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-md-9 -->

                <?php include "utility/customer-panel.php"; ?>

            </div>

        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->


    <!-- *** FOOTER ***
_________________________________________________________ -->

    <?php include "footer.php"; ?>



</div>
<!-- /#all -->

<!-- #### JAVASCRIPT FILES ### -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')
</script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/jquery.parallax-1.1.3.js"></script>
<script src="js/front.js"></script>

<?php
    $query = "DELETE FROM notifications WHERE recepientId='$userId'";
    $result = mysqli_query($con, $query) OR die(mysqli_error($con));
?>



</body>

</html>