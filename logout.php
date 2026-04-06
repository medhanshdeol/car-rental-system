<?php
session_start();
session_unset();
session_destroy(); // Clears all user data from the server
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out | DriveElite</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f8fafc url('https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Subtle overlay to match the geometric background in your screenshot */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.85);
            z-index: -1;
        }

        /* Navigation Bar */
        nav {
            padding: 20px 80px;
            display: flex;
            justify-content: flex-end;
            gap: 30px;
        }
        nav a { text-decoration: none; color: #64748b; font-weight: 500; font-size: 15px; transition: 0.3s; }
        nav a:hover { color: #0f172a; }
        nav a.active { color: #0f172a; font-weight: 700; border-bottom: 2px solid #113881; padding-bottom: 5px; }

        /* Centered Logout Card */
        .content-area {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 50px;
        }

        .logout-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 25px;
            padding: 60px 40px;
            width: 450px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        /* The Car Icon with Shield */
        .icon-container {
            position: relative;
            margin-bottom: 30px;
            display: inline-block;
        }
        .icon-container i.fa-car {
            font-size: 60px;
            color: #334155;
        }
        .icon-container i.fa-shield-check {
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 28px;
            color: #22c55e;
            background: white;
            border-radius: 50%;
        }

        h1 {
            font-size: 36px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 15px 0;
        }

        p {
            color: #475569;
            font-size: 18px;
            line-height: 1.6;
            margin: 0 0 40px 0;
        }

        /* The "Return Home" Button */
        .home-btn {
            display: inline-block;
            background: #113881; /* Matches the DriveElite theme */
            color: white;
            padding: 15px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(17, 56, 129, 0.2);
            transition: 0.3s;
            border: 1px solid #0a265a;
        }

        .home-btn:hover {
            transform: translateY(-2px);
            background: #0a265a;
            box-shadow: 0 15px 25px rgba(17, 56, 129, 0.3);
        }

        footer {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="index.php">Explore Cars</a>
    <a href="my_bookings.php">My Profile</a>
    <a href="#">My Account</a>
    <a href="logout.php" class="active">Logout</a>
</nav>

<div class="content-area">
    <div class="logout-card">
        <div class="icon-container">
            <i class="fa-solid fa-car"></i>
            <i class="fa-solid fa-circle-check fa-shield-check"></i>
        </div>

        <h1>Successfully Logged Out</h1>
        <p>Safe travels, and we look forward to driving with you again soon!</p>

        <a href="index.php" class="home-btn">Return to Home Page</a>
    </div>
</div>

<footer>
    
</footer>

</body>
</html>