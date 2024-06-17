<?php
global $conn;
require 'database/db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect_to=cart.php');
    exit();
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="CSS/display.css">
</head>
<body>
    <h2>Your Cart</h2>
    <div class="cart-items">
        <?php if (empty($cart_items)) { ?>
            <p>Your cart is empty.</p>
        <?php } else {
            // Assuming $conn is your database connection
           
                        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $placeholders = implode(',', array_fill(0, count($cart_items), '?'));
            $stmt = $conn->prepare("SELECT id, title, price, image FROM products WHERE id IN ($placeholders)");
            $stmt->bind_param(str_repeat('i', count($cart_items)), ...$cart_items);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<div class='cart-item'>
                        <img src='".$row['image']."' alt='".$row['title']."'>
                        <h2>".$row['title']."</h2>
                        <p>$".$row['price']."</p>
                      </div>";
            }

            $stmt->close();
            $conn->close();
        } ?>
    </div>
</body>
</html>
