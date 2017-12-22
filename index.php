<?php
    require "login_system/db.php"
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
                        <h1>Home Page</h1>
                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                <div class="row">


                    <!-- *** LEFT COLUMN ***
			_________________________________________________________ -->

                    <?php include "utility/categories.php";?>
                    <!-- *** LEFT COLUMN END *** -->

                    <!-- *** RIGHT COLUMN ***
			_________________________________________________________ -->

                    <div class="col-sm-9">

                        <p class="text-muted lead">We guarantee that those products are high quality products and it was carefully selected to satisfy our customers.</p>

                        <div class="row products">

                            <?php
                                $query = "SELECT ";
                                if(isset($_GET['category'])){
                                    switch($_GET['category']) {

                                    }
                                }
                            ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="image">
                                        <a href="shop-detail.php">
                                            <img src="img/product1.jpg" alt="" class="img-responsive image1">
                                        </a>
                                    </div>
                                    <!-- /.image -->
                                    <div class="text">
                                        <h3><a href="shop-detail.php">Fur coat with very but very very long name</a></h3>
                                        <p class="price">$143.00</p>
                                        <p class="buttons">
                                            <a href="shop-detail.php" class="btn btn-default">View detail</a>
                                            <a href="shop-basket.php" class="btn btn-template-main"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>
<!--                            <div class="col-md-4 col-sm-6">-->
<!--                                <div class="product">-->
<!--                                    <div class="image">-->
<!--                                        <a href="shop-detail.php">-->
<!--                                            <img src="img/product2.jpg" alt="" class="img-responsive image1">-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                    <!-- /.image -->-->
<!--                                    <div class="text">-->
<!--                                        <h3><a href="shop-detail.php">White Blouse Armani</a></h3>-->
<!--                                        <p class="price"><del>$280</del> $143.00</p>-->
<!--                                        <p class="buttons">-->
<!--                                            <a href="shop-detail.php" class="btn btn-default">View detail</a>-->
<!--                                            <a href="shop-basket.php" class="btn btn-template-main"><i class="fa fa-shopping-cart"></i>Add to cart</a>-->
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                    <!-- /.text -->-->
<!---->
<!--                                    <div class="ribbon sale">-->
<!--                                        <div class="theribbon">SALE</div>-->
<!--                                        <div class="ribbon-background"></div>-->
<!--                                    </div>-->
<!--                                    <!-- /.ribbon -->-->
<!---->
<!--                                    <div class="ribbon new">-->
<!--                                        <div class="theribbon">NEW</div>-->
<!--                                        <div class="ribbon-background"></div>-->
<!--                                    </div>-->
<!--                                    <!-- /.ribbon -->-->
<!--                                </div>-->
                                <!-- /.product -->
                            </div>
                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** RIGHT COLUMN END *** -->

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

</body>

</html>