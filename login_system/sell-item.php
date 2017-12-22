<?php
include "login_system/check-login.php";
if(!isLoggedIn())
    header("Location: customer-register.php?error=ERROR_NOT_LOGGED_IN");

    //TODO add implementation : "https://stackoverflow.com/questions/26757659/how-to-store-images-in-mysql-database-using-php"