<?php
include('db.php');

// If the Update button is clicked
if(isset($_POST['update_price'])){
    $car_id = $_POST['car_id'];
    $new_price = $_POST['new_price'];

    $sql = "UPDATE cars SET price = '$new_price' WHERE id = '$car_id'";
    
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Price Updated Successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Update Prices</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f4; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #34495e; color: white; }
        input[type="number"] { padding: 8px; width: 80px; }
        .btn { background: #27ae60; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Update Car Rental Prices (₹)</h2>
    <table>
        <tr>
            <th>Brand & Model</th>
            <th>Current Price</th>
            <th>New Price</th>
            <th>Action</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM cars");
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['brand'] . " " . $row['model'] . "</td>";
            echo "<td>₹" . $row['price'] . "</td>";
            echo "<td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='car_id' value='".$row['id']."'>
                        <input type='number' name='new_price' required>
                  </td>";
            echo "<td><button type='submit' name='update_price' class='btn'>Update</button></form></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">← Back to Gallery</a>
</body>
</html>