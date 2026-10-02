<?php

date_default_timezone_set("Asia/Kolkata");

$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "library_study_center_db";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $databasename);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
