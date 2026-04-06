<?php
session_start();
include('db.php');

if(isset($_GET['car_id']) && isset($_SESSION['user_id'])){
    $car_id = $_GET['car_id'];
    $user_id = $_SESSION['user_id'];
    
   
    $res = mysqli_query($conn, "SELECT price FROM cars WHERE id = '$car_id'");
    $car = mysqli_fetch_assoc($res);
    $total = $car['price'] + 1000;

   
    $sql = "INSERT INTO bookings (user_id, car_id, total_amount) VALUES ('$user_id', '$car_id', '$total')";
    
    if(mysqli_query($conn, $sql)){
        
        header("Location: my_bookings.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: login.php");
}
?>