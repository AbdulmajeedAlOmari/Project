<?php
include "login_system/check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");
?>
<?php
require "login_system/db.php";
if(isset($_COOKIE['auth'])) {
    $username = $_COOKIE['auth'];
}else {
    $username = $_SESSION['auth'];
}
$query = "SELECT id FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

$query = "SELECT items.itemId,items.image,items.itemName,items.price FROM items, wishlist WHERE wishlist.id='$id' AND wishlist.itemId=items.itemId";
$result = mysqli_query($con, $query) OR die(mysqli_error($con));
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
                    <div class="col-md-7">
                        <h1>My wishlist</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">

                            <li><a href="index.html">Home</a>
                            </li>
                            <li>My wishlist</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                <div class="row">

                    <!-- *** LEFT COLUMN ***
		     _________________________________________________________ -->

                    <div class="col-md-9 clearfix">

                        <p class="lead">Theses are the items in your wishlist</p>

                        <div class="row products">

                            <?php
                            if(mysqli_num_rows($result) == 0)
                                echo "<div class=\"alert alert-info\" role=\"alert\"> There are no items now, <strong>comeback later!</strong> </div>";
                            else {
                                while($row = mysqli_fetch_array($result)) {
                                    echo "<div class=\"col-md-4 col-sm-6\">";
                                    echo "<div class=\"product\">";
                                    /* image */
                                    echo "<div class=\"image\">";
                                    echo "<a href=\"shop-detail.php?itemId=". $row['itemId'] ."\">";
                                    echo "<img src=\"login_system/uploads/".$row['image']."\" alt=\"\" class=\"img-responsive image1\">";
                                    echo "</a>";
                                    echo "</div>";
                                    /* END image */

                                    /* text */
                                    echo "<div class=\"text\">";
                                    echo "<h3><a href=\"shop-detail.php\">". $row['itemName'] ."</a></h3>";
                                    echo "<p class=\"price\">". $row['price'] ."&#36;</p>";
                                    echo "<p class=\"buttons\">";
                                    echo "<a href=\"shop-detail.php?itemId=". $row['itemId'] ."\" class=\"btn btn-default\">View detail</a>";
                                    echo "</p>";
                                    echo "</div>";
                                    /* END text */

                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>

                        <!-- /.products -->

                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** LEFT COLUMN END *** -->

                    <!-- *** RIGHT COLUMN ***
		     _________________________________________________________ -->



                    <!-- *** RIGHT COLUMN END *** -->

                </div>
                <!-- /.row -->

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

    



</body>

</html>