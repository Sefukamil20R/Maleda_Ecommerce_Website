<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit();
}

// Fetch the cart from the session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Example functions for adding, updating, and removing items from cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
        $product_id = $_POST['product_id']; // Example POST data
        // Add item to cart logic
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update_cart') {
        // Update item quantity in cart logic
    } elseif (isset($_POST['action']) && $_POST['action'] == 'remove_from_cart') {
        // Remove item from cart logic
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="../CSS/header-style.css">
    <link rel="stylesheet" href="../CSS/product-listing.css">
    <style>
        /* Additional styles or adjustments specific to this page can be added here */
        .cart-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .cart-item {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100%;
            border-radius: 10px;
        }

        .cart-item h2 {
            margin: 10px 0;
            font-size: 20px;
        }

        .cart-item p {
            margin: 10px 0;
            font-size: 16px;
            text-align: left;
        }

        .cart-item .quantity {
            font-weight: bold;
        }

        .cart-item .total {
            font-weight: bold;
        }

        .cart-item .action {
            margin-top: 10px;
        }

        .cart-item .action a {
            color: var(--dark);
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        .cart-item .action a:hover {
            color: var(--accent);
        }
    </style>
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Your Shopping Cart</h1>
        <div class="cart-items">
            <?php if (empty($cart)) : ?>
                <p>Your cart is empty.</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $product_id => $item) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['price']); ?></td>

                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                                <td><a href="remove_from_cart.php?id=<?php echo $product_id; ?>">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table><br>
                <a href="checkout.php">Proceed to Checkout</a>
            <?php endif; ?>
        </div>
    </div> <!-- Close the container div here -->

    <?php include '../includes/footer.php'; ?>

</body>

</html>