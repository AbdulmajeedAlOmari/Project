<?php
include "login_system/check-login.php";
if(isLoggedIn())
    header("Location: index.php");
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

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800'
          rel='stylesheet' type='text/css'>

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
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png"/>
</head>

<body>


<div id="all">
    <?php include "header.php"; ?>

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1>New account / Sign in</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <?php
                if(isset($_GET['error'])) {
                    require "utility/errors.php";
                    $error = getError($_GET['error']);
                    echo $error;
                    unset($_GET['error']);
                }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <?php
                        if (isset($_GET['register-error'])) {
                            require "utility/errors.php";
                            $error = getError($_GET['register-error']);
                            echo $error;
                            unset($_GET['error']);
                        } else if (isset($_GET['register-msg'])) {
                            if ($_GET['register-msg'] == 'successful')
                                echo "<div class='alert alert-success' role='alert'>You have been registered succesfully!</div>";
                            
                            unset($_GET['register-msg']);
                        }
                        ?>
                        <h2 class="text-uppercase">New account</h2>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to
                            you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact
                                us</a>, our customer service center is working for you 24/7.</p>

                        <hr>
                        <span id="error-register"></span>
                        <form name="registerationForm" action="login_system/validate-registeration.php" method="post">
                            <div class="form-group">
                                <label for="name-login">Username</label>
                                <input type="text" class="form-control" name="username" id="name-register" required>
                            </div>
                            <div class="form-group">
                                <label for="email-login">Email</label>
                                <input type="text" class="form-control" name="email" id="email-register" required>
                            </div>
                            <div class="form-group">
                                <label for="password-login">Password</label>
                                <input type="password" class="form-control" name="password" id="password-register"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="passwordconfirm-login">Password Confirmation</label>
                                <input type="password" class="form-control" name="passwordconfirmation"
                                       id="passwordconfirm-register" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i>Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <?php
                        if (isset($_GET['login-error'])) {
                            require "utility/errors.php";
                            $error = getError($_GET['login-error']);
                            echo $error;
                            unset($_GET['login-error']);
                        }
                        ?>
                        <h2 class="text-uppercase">Login</h2>

                        <p class="lead">Already our customer?</p>
                        <p class="text-muted">If you already have an account sign in using your own Email and Password.</p>

                        <hr>
                        <form name="loginForm" action="login_system/validate-login.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email-login" name="email-login">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password-login" name="password-login">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

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