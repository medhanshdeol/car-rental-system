<?php
session_start();
include('db.php');
$error = "";

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        // Checking if the encrypted password matches
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php"); // Send them to the gallery
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "No user found with that email!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login - Car Rental</title></head>
<body style="font-family: sans-serif; display: flex; justify-content: center; padding-top: 100px; background: #f4f4f4;">
    <div style="background: white; padding: 30px; border-radius: 10px; width: 300px; box-shadow: 0 0 10px #ccc;">
        <h2>Login</h2>
        <p style="color:red;"><?php echo $error; ?></p>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" style="width:100%; padding:10px; margin:10px 0;" required><br>
            <input type="password" name="password" placeholder="Password" style="width:100%; padding:10px; margin:10px 0;" required><br>
            <button type="submit" name="login_btn" style="width:100%; padding:10px; background:#007bff; color:white; border:none; cursor:pointer;">Login</button>
        </form>
        <p>New user? <a href="signup.php">Register here</a></p>
    </div>
</body>
</html>