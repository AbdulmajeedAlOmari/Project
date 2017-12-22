<?php
    if(isset($_GET['itemId'])) {
        require "login_system/db.php";
        $itemId = $_GET['itemId'];

        $query = "SELECT itemId,sellerId,description,image,itemName,price FROM items WHERE itemId='$itemId'";
        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) == 0)
            header("Location: index.php?error=ERROR_INCORRECT_ITEM_ID");

        $row = mysqli_fetch_array($result);
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
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
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
                    <?php echo "<h1>" . $row['itemName'] . "</h1>"?>
                </div>

                <div class="col-md-5">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <?php echo "<li>" . $row['itemName'] . "</li>"?>
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

                <div class="col-md-9">
                    <p class="goToDescription"><a href="#details" class="scroll-to text-uppercase">Scroll to see item's description</a></p>

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <?php echo "<img src=\"login_system/uploads/". $row['image'] ."\" alt=\"\" class=\"img-responsive\">"?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box">

                                <?php
                                //TODO get itemId
                                $itemid = 0;
                                echo "<form action='login_system/add-to-wishlist.php?itemid=$itemid' method='post'>"
                                ?>
                                    <div class="sizes">
                                        <h3>Price</h3>
                                    </div>

                                    <?php
                                        //TODO add price
                                        echo "<p class=\"price\">$124.00</p>";
                                    ?>

                                    <p class="text-center">
                                        <form action="login_system/add-to-wishlist.php" method="post">
                                            <button type="submit" class="btn btn-template-main"><i class="fa fa-heart-o"></i> Add to wishlist</button>
                                        </form>
                                    </p>
                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">

                        <?php
                            //TODO post item details here
                            echo "<h4>Item Description</h4>";
                            echo $row['description'] . "<br><br>";
                        ?>


                        <?php
                        if(isset($_COOKIE['auth']) || isset($_SESSION['auth'])) {
                            $sellerId = $row['sellerId'];
                            $query = "SELECT email,firstName,lastName,phoneNumber,street,zip,state,country FROM users WHERE id='$sellerId'";
                            $result = mysqli_query($con, $query) OR die(mysqli_error($con));
                            $contactInfo = mysqli_fetch_array($result);

                            $firstName = $contactInfo['firstName'];
                            $lastName = $contactInfo['lastName'];
                            $name = empty($firstName) && empty($lastName) ? 'Unknown' : $firstName." ".$lastName;

                            $phoneNumber = empty($contactInfo['phoneNumber']) ? 'Unknown' : $contactInfo['phoneNumber'];
                            $email = empty($contactInfo['email']) ? 'Unknown' : $contactInfo['email'];
                            $country = empty($contactInfo['country']) ? 'Unknown' : $contactInfo['country'];
                            $state = empty($contactInfo['state']) ? 'Unknown' : $contactInfo['state'];
                            $street = empty($contactInfo['street']) ? 'Unknown' : $contactInfo['street'];
                            $zip = empty($contactInfo['zip']) ? 'Unknown' : $contactInfo['zip'];

                            echo "<h4>Contact Details</h4>
                            <ul>
                                <li>Name: $name</li>
                                <li>Mobile Number: $phoneNumber</li>
                                <li>Email: $email</li>
                                <li>Country: $country</li>
                                <li>State: $state</li>
                                <li>Street: $street</li>
                                <li>Zip: $zip</li>
                            </ul>";
                        } else {
                            echo "<div class=\"alert alert-warning\" role=\"alert\">You have to login to see contact details</div>";
                        } ?>

<!--                        <blockquote>-->
<!--                            <p><em>Define style this season with Armani's new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em>-->
<!--                            </p>-->
<!--                        </blockquote>-->
                    </div>

                    <div class="box social" id="product-social">
                        <h4>Show it to your friends</h4>
                        <p>
                            <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>

                </div>
                <!-- /.col-md-9 -->


                <!-- *** LEFT COLUMN END *** -->

                <!-- *** RIGHT COLUMN ***
      _________________________________________________________ -->

                <?php include "utility/categories.php"; ?>

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