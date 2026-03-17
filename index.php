<?php 
session_start(); // This tells PHP to look for that "VIP badge" (Session)
include('db.php'); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Rental - Home</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #f8f9fa; }
        nav { background: #2c3e50; color: white; padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
        .hero { text-align: center; padding: 50px; background: #34495e; color: white; }
        .container { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 40px; }
        .car-card { background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 250px; padding: 20px; text-align: center; }
        .price { color: #27ae60; font-size: 1.2em; font-weight: bold; }
        .rent-btn { display: block; margin-top: 15px; background: #e67e22; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5em;">🚗 CarRental Pro</div>
    <div>
        <?php if(isset($_SESSION['user_name'])): ?>
            <span>Welcome, <?php echo $_SESSION['user_name']; ?>!</span>
            <a href="logout.php" style="color: #ff7675;">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </div>
</nav>

<div class="hero">
    <h1>Find Your Perfect Ride</h1>
    <p>Secure, fast, and easy car rentals at your fingertips.</p>
</div>

<div class="container">
    <?php
    $sql = "SELECT * FROM cars";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='car-card'>";
            echo "<h3>" . $row['brand'] . " " . $row['model'] . "</h3>";
            echo "<p class='price'>₹" . $row['price'] . " / day</p>";
            echo "<a href='checkout.php?car_id=" . $row['id'] . "' class='rent-btn'>Rent Now</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No cars found in the database.</p>";
    }
    ?>
</div>

</body>
</html>