
<?php
session_start();
include('db.php');
$error = "";

if(isset($_POST['login_btn'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "No account found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | DriveElite</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            /* Background matches the light, clean road aesthetic */
            background: #f0f2f5 url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Subtle overlay to brighten the background slightly */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.7);
            z-index: -1;
        }

        .logo-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 40px;
            width: 380px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        h2 { margin: 0; font-size: 24px; color: #000; font-weight: 700; }
        p.subtitle { margin: 5px 0 25px 0; color: #64748b; font-size: 14px; }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
        }

        .forgot-pass {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 25px;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #113881; /* Deep premium blue from your screenshot */
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(17, 56, 129, 0.3);
        }

        .login-btn:hover {
            background: #0a265a;
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #1e293b;
        }

        .register-link a {
            color: #6d28d9;
            text-decoration: none;
            font-weight: 600;
        }

        .error-msg {
            color: #dc2626;
            font-size: 12px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="logo-container">
    <div class="logo-text">⚡ DriveElite</div>
</div>

<div class="login-card">
    <h2>Login</h2>
    <p class="subtitle">Access your premium rentals</p>

    <?php if($error != ""): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <a href="#" class="forgot-pass">Forgot Password?</a>

        <button type="submit" name="login_btn" class="login-btn">Login</button>
    </form>

    <div class="register-link">
        New user? <a href="signup.php">Register here</a>
    </div>
</div>

</body>
</html>