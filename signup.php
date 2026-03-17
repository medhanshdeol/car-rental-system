<?php 
include('db.php'); // Connects to your database
$msg = "";

if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // password_hash makes the password secret in the database
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 

    // SQL to save the user
    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$pass')";
    
    if(mysqli_query($conn, $sql)){
        $msg = "<p style='color:green; font-weight:bold;'>Account Created! <a href='login.php'>Login here</a></p>";
    } else {
        $msg = "<p style='color:red;'>Error: That email might already be registered.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Car Rental</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .signup-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { color: #333; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #218838; }
        .login-link { margin-top: 15px; display: block; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

    <div class="signup-box">
        <h2>Create Account</h2>
        <?php echo $msg; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="pass" placeholder="Create Password" required>
            <button type="submit" name="register">Sign Up</button>
        </form>
        <a href="login.php" class="login-link">Already have an account? Login</a>
    </div>

</body>
</html>