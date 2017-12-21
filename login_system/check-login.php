<?php

function isLoggedIn() {
    return isset( $_COOKIE['auth']) || (session_status()==2 && isset($_SESSION['auth']) );
}

