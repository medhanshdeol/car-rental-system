<?php
$username = "root";
$password = "";
$dbname = "car_rental_db";

// Try Port 3306 first (Standard MySQL port)
$conn = @mysqli_connect("localhost:3306", $username, $password, $dbname);

// If 3306 fails, try Port 3308 (WAMP's alternative port)
if (!$conn) {
    $conn = mysqli_connect("localhost:3308", $username, $password, $dbname);
}

// Final check: If both failed, stop and show the error
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>