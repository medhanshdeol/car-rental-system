<?php 
session_start();
include('db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveElite | Premium Car Rentals</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --accent-orange: #e67e22;
            --price-green: #27ae60;
            --text-dark: #000000;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            /* High-end showroom background */
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* Bright, soft overlay for the showroom feel */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 245, 0.4); /* Soft warm tint */
            z-index: -1;
        }

        /* Navbar Styling */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
        }
        .logo { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 8px; color: #000; }
        .logo i { color: var(--accent-orange); }

        .nav-links a { 
            text-decoration: none; 
            color: #000; 
            font-size: 14px; 
            font-weight: 600; 
            margin-left: 25px; 
        }

        /* Hero Section */
        .hero { text-align: center; margin-top: 50px; }
        .hero h1 { font-size: 3.5rem; font-weight: 800; margin: 0; color: #000; }
        .hero p { font-size: 1.1rem; color: #333; margin: 10px 0 40px 0; font-weight: 400; }

        /* Search Bar */
        .search-container { display: flex; justify-content: center; margin-bottom: 60px; }
        .search-bar {
            background: white;
            padding: 15px 30px;
            border-radius: 50px;
            width: 550px;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .search-bar i { color: #3498db; margin-right: 15px; font-size: 18px; }
        .search-bar input { border: none; outline: none; width: 100%; font-size: 16px; color: #666; font-family: 'Poppins'; }

        /* Card Grid - 4 Columns */
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 0 80px 80px 80px;
        }

        /* Soft Glassmorphism Card */
        .car-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 25px;
            padding: 35px 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0,0,0,0.03);
        }
        .car-card:hover { transform: translateY(-8px); background: rgba(255, 255, 255, 0.6); box-shadow: 0 20px 40px rgba(0,0,0,0.06); }

        .car-icon { height: 30px; margin-bottom: 15px; }
        .car-name { font-size: 1.3rem; font-weight: 700; margin: 10px 0; color: #000; }
        .car-price { color: var(--price-green); font-weight: 600; font-size: 1.1rem; margin-bottom: 25px; }

        /* The Orange Button */
        .rent-btn {
            display: inline-block;
            background: linear-gradient(to right, #e67e22, #d35400);
            color: white;
            padding: 12px 45px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 8px 20px rgba(230, 126, 34, 0.4);
            transition: 0.3s;
        }
        .rent-btn:hover { transform: scale(1.05); box-shadow: 0 12px 25px rgba(230, 126, 34, 0.5); }

        /* Responsive */
        @media (max-width: 1200px) { .container { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .container { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <i class="fa-solid fa-bolt"></i> DriveElite
    </div>
    <div class="nav-links">
        <?php if(isset($_SESSION['user_name'])): ?>
            <a href="my_bookings.php">My History</a>
            <a href="logout.php">Logout (<?php echo $_SESSION['user_name']; ?>)</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </div>
</nav>

<div class="hero">
    <h1>Find Your Perfect Ride</h1>
    <p>Secure, fast, and easy car rentals at your fingertips.</p>
    
    <div class="search-container">
        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search for a car model, type, or price...">
        </div>
    </div>
</div>

<div class="container">
    <?php
    $sql = "SELECT * FROM cars";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Replicating that small racing/F1 icon from your screenshot
            echo "<div class='car-card'>";
            echo "<div class='car-icon'><img src='https://cdn-icons-png.flaticon.com/512/3202/3202926.png' style='height:40px; filter: grayscale(1) brightness(0.5);'></div>";
            echo "<div class='car-name'>" . $row['brand'] . " " . $row['model'] . "</div>";
            echo "<div class='car-price'>₹" . number_format($row['price'], 2) . " / day</div>";
            echo "<a href='checkout.php?car_id=" . $row['id'] . "' class='rent-btn'>Rent Now</a>";
            echo "</div>";
        }
    } else {
        echo "<p style='grid-column: 1/-1; text-align: center; color: #666;'>Our fleet is currently out on the road. Check back soon!</p>";
    }
    ?>
</div>

</body>
</html>