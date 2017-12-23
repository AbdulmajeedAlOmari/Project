<?php
require "login_system/db.php";

$flag = false;
if(isset($_COOKIE['auth']) || isset($_SESSION['auth'])) {
    if(isset($_COOKIE['auth'])) {
        $username = $_COOKIE['auth'];
    } else {
        $username = $_SESSION['auth'];
    }
    $q = "SELECT id FROM users WHERE username='$username'";
    $r = mysqli_query($con,$q) OR die(mysqli_error($con));
    $row = mysqli_fetch_array($r);
    $userId = $row['id'];
    $q = "SELECT * FROM notifications WHERE recepientId='$userId'";
    $r = mysqli_query($con,$q) OR die(mysqli_error($con));
    if(mysqli_num_rows($r)!=0){
        $flag = true;
    }
}

?>
<header>
    <!-- *** TOP ***
_________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-5 contact">
                    <p class="hidden-sm hidden-xs">Contact us on contact@eshop.com.</p>
                    <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a>  <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                    </p>
                </div>
                <div class="col-xs-7">
                    <div class="login">
                        <?php

                            if(isset($_COOKIE['auth']) || isset($_SESSION['auth']) ) {
                                $username = '';

                                if(isset($_COOKIE['auth']))
                                    $username = $_COOKIE['auth'];
                                else
                                    $username = $_SESSION['auth'];

                                ?>
                                <span class="hidden-sm hidden-xs welcomeMessage">Welcome, <?php echo "$username"?>!</span>
                                <a href="login_system/logout.php"><i class="fa fa-sign-out"></i> <span class="hidden-xs text-uppercase">Logout</span></a>
                                <a href="customer-account.php"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Account</span></a>
                                <a href="my-items.php"><i class="fa fa-list"></i> <span class="hidden-xs text-uppercase">My items</span></a>
                                <a href="customer-notifications.php"><i class="fa fa-bell"></i> <span class="hidden-xs text-uppercase">Notifications</span>
                                    <?php if($flag) echo "<i class=\"fa fa-circle red\"></i>"?></a>
                                <?php
                            } else {
                                ?>
                                <a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Sign in</span></a>
                                <a href="customer-register.php"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Sign up</span></a>
                                <?php
                            }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- *** TOP END *** -->

    <!-- *** NAVBAR ***
_________________________________________________________ -->

    <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

        <div class="navbar navbar-default yamm" role="navigation" id="navbar">

            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand home" href="index.php">
                        <img src="img/eshop-logo.png" alt="eShop logo" class="hidden-xs hidden-sm">
                        <img src="img/eshop-logo.png" alt="eShop logo" class="visible-xs visible-sm"><span class="sr-only">eShop - go to homepage</span>
                    </a>
                    <div class="navbar-buttons">
                        <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-align-justify"></i>
                        </button>
                    </div>
                </div>
                <!--/.navbar-header -->

                <div class="navbar-collapse collapse" id="navigation">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <!--                            <li><a href="shop-category-left.php">TESTING</a></li>-->
                    </ul>
                </div>
                <!--/.nav-collapse -->



                <div class="collapse clearfix" id="search">

                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">

                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>

                </span>
                        </div>
                    </form>

                </div>
                <!--/.nav-collapse -->

            </div>


        </div>
        <!-- /#navbar -->

    </div>

    <!-- *** NAVBAR END *** -->

</header>


<!-- *** LOGIN MODAL ***
_________________________________________________________ -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="Login">Customer login</h4>
            </div>
            <div class="modal-body">
                <form action="login_system/validate-login.php" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email_modal" placeholder="email" name="email-login" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_modal" placeholder="password" name="password-login" required>
                    </div>

                    <p class="text-center">
                        <button type="submit" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in</button>
                    </p>
                </form>

                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="customer-register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>
            </div>
        </div>
    </div>
</div>

<!-- *** LOGIN MODAL END *** -->

