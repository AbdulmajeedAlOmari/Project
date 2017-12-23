<?php
include "login_system/check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

if(isset($_COOKIE['auth']))
    $username = $_COOKIE['auth'];
else
    $username = $_SESSION['auth'];
require "login_system/db.php";

if(isset($_GET['itemId']) && isset($_GET['userId'])) {
    $itemId = $_GET['itemId'];
    $userId = $_GET['userId'];

    unset($_GET['itemId']);
    unset($_GET['userId']);

    $query = "SELECT id FROM users WHERE username='$username'";
    $result = mysqli_query($con, $query) OR die(mysqli_error($con));

    if(mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);

        if($row['id'] == $userId) {
            $query = "SELECT category,description,itemName,price,quantity FROM items WHERE itemId='$itemId' AND sellerId='$userId'";
            $result = mysqli_query($con, $query) OR die(mysqli_error($con));

            if(mysqli_num_rows($result) != 0) {
                $row = mysqli_fetch_array($result);
            }

        }
    }
} else {
    header("Location: my-items.php?error=ERROR_MODIFY_REJECT");
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
                    <h1>My account</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb">

                        <li><a href="index.html">Home</a>
                        </li>
                        <li>My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="clearfix">

        <div class="container">

            <div class="row">

                <!-- *** LEFT COLUMN ***
         _________________________________________________________ -->
                <?php
                if(isset($_GET['msg'])) {
                    if ($_GET['msg'] == 'successful')
                        echo "<div class='alert alert-success' role='alert'>Your item has been posted successfully!</div>";
                    unset($_GET['msg']);
                }
                ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Important!</strong> You need to make sure that you filled all your contact details in (Account) tab, so customers can contact you!
                </div>

                <div class="col-md-9 clearfix" id="customer-account">

                    <p class="lead">Put your item's information here.</p>
                    <p class="text-muted">It is necessary to fill the item description correctly to get as many customers as possible.</p>

                    <div class="box clearfix">
                        <div class="heading">
                            <h3 class="text-uppercase">Item Description</h3>
                        </div>
                        <form <?php echo "action=\"login_system/edit-item.php?itemId=$itemId&userId=$userId\"" ?> method="post" enctype="multipart/form-data">
                            <?php
                            if(isset($_GET['error'])) {
                                require "utility/errors.php";
                                $error = getError($_GET['error']);
                                echo $error==''? '' : "<div class=\"row\">
                                <div class=\"col-sm-12\">" . constant($_GET['error']) . "</div>
                            </div>";
                                unset($_GET['error']);
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category">
                                            <option <?php if($row['category']=="Cars") echo "selected"; //TODO check if correct ?>>Cars</option>
                                            <option <?php if($row['category']=="Plants") echo "selected"; ?>>Plants</option>
                                            <option <?php if($row['category']=="Animals") echo "selected"; ?>>Animals</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="itemName" required <?php echo "value=".$row['itemName']?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" required <?php echo "value=".$row['description']?>>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" required <?php echo "value=".$row['price']?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required <?php echo "value=".$row['quantity']?>>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="image">Upload image</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" name="submit" class="btn btn-template-main"><i class="fa fa-floppy-o"></i> SAVE CHANGES</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.col-md-9 -->

                <!-- *** LEFT COLUMN END *** -->

                <!-- *** RIGHT COLUMN ***
         _________________________________________________________ -->

                <?php include "utility/customer-panel.php"; ?>

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <!-- *** RIGHT COLUMN END *** -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->

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