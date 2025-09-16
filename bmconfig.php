<?php
// Database configuration
$host     = "localhost";   // or your DB host
$username = "brickearthrealty_campaign_user";
$password = "aXKUWt@+_p]z";
$dbname   = "brickearthrealty_campaign_db";

// Create connection
$con = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 (important for special characters)
mysqli_set_charset($con, "utf8");
?>