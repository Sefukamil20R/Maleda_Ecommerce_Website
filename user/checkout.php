<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit();
}

// Fetch cart items from session or database
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle payment and place order logic
    // Save the order to the database and process the payment

    // Clear the cart
    unset($_SESSION['cart']);

    // Display a success message
    echo "<p>Thank you for your order! Your order has been placed successfully.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Checkout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/login.css" />
    <link rel="stylesheet" href="../CSS/header-style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>Checkout</h1>
        <?php if (empty($cart)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <form action="checkout.php" method="post">
                <h2>Order Summary</h2>
                <ul>
                    <?php foreach ($cart as $item) : ?>
                        <li><?php echo htmlspecialchars($item['title']); ?> - $<?php echo htmlspecialchars($item['price']); ?> x <?php echo htmlspecialchars($item['quantity']); ?> = $<?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="submit">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>