<?php
session_start();
include('db.php');

if(isset($_GET['car_id']) && isset($_SESSION['user_id'])){
    $car_id = $_GET['car_id'];
    $user_id = $_SESSION['user_id'];
    
    // 1. Get the price again to save it in history
    $res = mysqli_query($conn, "SELECT price FROM cars WHERE id = '$car_id'");
    $car = mysqli_fetch_assoc($res);
    $total = $car['price'] + 1000; // Price + Deposit

    // 2. Save into the Bookings table
    $sql = "INSERT INTO bookings (user_id, car_id, total_amount) VALUES ('$user_id', '$car_id', '$total')";
    
    if(mysqli_query($conn, $sql)){
        // 3. Success! Redirect to the history page
        header("Location: my_bookings.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: login.php");
}
?>