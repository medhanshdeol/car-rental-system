<?php
include('db.php'); 

if(isset($_POST['add_btn'])){
    
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];

    $sql = "INSERT INTO cars (brand, model, price, status) VALUES ('$brand', '$model', '$price', 'Available')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('New Car Added Successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car - Admin</title>
    <style>
        body { font-family: sans-serif; padding: 50px; background-color: #f4f4f4; }
        .form-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px #ccc; width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;}
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Car</h2>
    <form method="POST">
        <input type="text" name="brand" placeholder="Car Brand (e.g. Toyota)" required>
        <input type="text" name="model" placeholder="Car Model (e.g. Camry)" required>
        <input type="number" name="price" placeholder="Price Per Day (₹)" required>
        <button type="submit" name="add_btn">Save Car to Database</button>
    </form>
</div>

</body>
</html>