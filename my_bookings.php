
<?php
session_start();
include('db.php');

if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }
$uid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | DriveElite</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            color: #1e293b;
        }

        /* Top Navigation */
        nav {
            background: white;
            padding: 15px 80px;
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        nav a { text-decoration: none; color: #64748b; font-weight: 500; font-size: 15px; }
        nav a.active { color: #0f172a; font-weight: 700; border-bottom: 2px solid #113881; padding-bottom: 5px; }

        .main-content { padding: 40px 100px; max-width: 1000px; margin: 0 auto; }

        /* Header Section */
        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .page-header i { font-size: 35px; color: #64748b; }
        .page-header h1 { font-size: 32px; margin: 0; font-weight: 800; color: #0f172a; }

        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        
        .back-btn {
            padding: 10px 20px;
            border: 2px solid #113881;
            color: #113881;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-area { display: flex; gap: 10px; }
        .search-area input { padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; width: 250px; }
        .search-area select { padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; color: #64748b; }

        /* Transaction Cards */
        .history-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
        }

        .car-img { width: 80px; margin-right: 30px; opacity: 0.8; }

        .car-details { flex-grow: 1; }
        .car-details h3 { margin: 0; font-size: 22px; font-weight: 700; }
        .car-details p { margin: 5px 0 0 0; color: #64748b; font-size: 14px; }

        .payment-info { text-align: right; }
        .payment-info h2 { margin: 0; font-size: 24px; font-weight: 800; }
        .payment-info span { font-size: 13px; color: #64748b; display: block; margin-bottom: 10px; }

        .status-badge {
            background: #e8f6f3;
            color: #27ae60;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .receipt-link {
            display: block;
            margin-top: 10px;
            font-size: 12px;
            color: #113881;
            text-decoration: underline;
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="index.php">Explore Cars</a>
    <a href="#" class="active">My Profile</a>
    <a href="#">My Account</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="main-content">
    <div class="page-header">
        <i class="fa-solid fa-clipboard-list"></i>
        <h1>Your Rental History</h1>
    </div>

    <div class="toolbar">
        <a href="index.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Gallery</a>
        <div class="search-area">
            <input type="text" placeholder="Search past rentals...">
            <select>
                <option>Filter by</option>
            </select>
        </div>
    </div>

    <?php
    $sql = "SELECT bookings.*, cars.brand, cars.model 
            FROM bookings 
            JOIN cars ON bookings.car_id = cars.id 
            WHERE bookings.user_id = '$uid' 
            ORDER BY bookings.booking_date DESC";
            
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <div class='history-card'>
                <img src='https://cdn-icons-png.flaticon.com/512/3202/3202926.png' class='car-img' alt='car-icon'>
                <div class='car-details'>
                    <h3>" . $row['brand'] . " " . $row['model'] . "</h3>
                    <p>Booking Date: " . date('d M Y • H:i:s', strtotime($row['booking_date'])) . "</p>
                </div>
                <div class='payment-info'>
                    <h2>₹" . number_format($row['total_amount'], 2) . "</h2>
                    <span>Total Paid</span>
                    <div class='status-badge'>Status: Completed</div>
                    <a href='#' class='receipt-link'>View Detailed Receipt</a>
                </div>
            </div>";
        }
    } else {
        echo "<p style='text-align:center; margin-top:50px;'>No rentals found.</p>";
    }
    ?>
</div>

</body>
</html>