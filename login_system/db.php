<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'users';
$con = mysqli_connect($host,$user,$pass,$db);

if (mysqli_connect_errno())
    die("Failed to connect to database : ".mysqli_connect_error());