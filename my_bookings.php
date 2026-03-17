<?php
session_start();
include('db.php');

if(!isset($_SESSION['user_id'])){ header("Location: login.php"); }
$uid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Transactions</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f4f4f4; }
        .receipt { background: white; padding: 20px; border-radius: 8px; margin-bottom: 15px; border-left: 5px solid #27ae60; box-shadow: 0 2px 5px #ccc; }
        .date { color: #7f8c8d; font-size: 0.8em; }
    </style>
</head>
<body>
    <h1>📋 Your Rental History</h1>
    <a href="index.php">← Back to Gallery</a>
    <hr>

    <?php
    // We join 'bookings' and 'cars' to show the Car Name instead of just an ID number
    $sql = "SELECT bookings.*, cars.brand, cars.model 
            FROM bookings 
            JOIN cars ON bookings.car_id = cars.id 
            WHERE bookings.user_id = '$uid' 
            ORDER BY bookings.booking_date DESC";
            
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='receipt'>";
            echo "<strong>" . $row['brand'] . " " . $row['model'] . "</strong>";
            echo "<p>Total Paid: ₹" . $row['total_amount'] . "</p>";
            echo "<span class='date'>Booked on: " . $row['booking_date'] . "</span>";
            echo "</div>";
        }
    } else {
        echo "<p>You haven't rented any cars yet!</p>";
    }
    ?>
</body>
</html>