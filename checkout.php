<?php
session_start();
include('db.php');

// 1. Check if a car was actually selected
if(!isset($_GET['car_id'])){
    header("Location: index.php");
    exit();
}

$car_id = $_GET['car_id'];

// 2. Fetch the specific car details
$query = "SELECT * FROM cars WHERE id = '$car_id'";
$result = mysqli_query($conn, $query);
$car = mysqli_fetch_assoc($result);

if(!$car){
    die("Car not found!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - <?php echo $car['brand']; ?></title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; padding: 50px; display: flex; justify-content: center; }
        .checkout-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 400px; }
        .summary-item { display: flex; justify-content: space-between; margin: 15px 0; border-bottom: 1px dashed #ddd; padding-bottom: 10px; }
        .total { font-size: 1.5em; font-weight: bold; color: #27ae60; }
        .confirm-btn { display: block; width: 100%; padding: 15px; background: #27ae60; color: white; border: none; border-radius: 8px; font-size: 1.1em; cursor: pointer; text-align: center; text-decoration: none; margin-top: 20px;}
    </style>
</head>
<body>

<div class="checkout-card">
    <h2>Booking Summary</h2>
    <p>Please review your selection before confirming.</p>
    <hr>

    <div class="summary-item">
        <span>Car Selected:</span>
        <strong><?php echo $car['brand'] . " " . $car['model']; ?></strong>
    </div>

    <div class="summary-item">
        <span>Daily Rate:</span>
        <strong>₹<?php echo $car['price']; ?></strong>
    </div>

    <div class="summary-item">
        <span>Security Deposit:</span>
        <strong>₹1,000</strong>
    </div>

    <div class="summary-item total">
        <span>Estimated Total:</span>
        <span>₹<?php echo $car['price'] + 1000; ?></span>
    </div>

    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="confirm_booking.php?car_id=<?php echo $car_id; ?>" class="confirm-btn">Confirm & Pay Now</a>
    <?php else: ?>
        <p style="color:red; text-align:center;">Please <a href="login.php">Login</a> to complete the booking.</p>
    <?php endif; ?>

    <a href="index.php" style="display:block; text-align:center; margin-top:15px; color:#7f8c8d; text-decoration:none;">Cancel and go back</a>
</div>

</body>
</html>