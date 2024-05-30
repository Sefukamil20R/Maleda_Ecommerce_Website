<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>checkout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/
login.css">
    <link rel="stylesheet" href="../CSS/
profile.css">
    <link rel="stylesheet" href="../CSS/header-style.css">
</head>


<body>

    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>User Dashboard</h1>
        <!-- Navigation Menu -->
        <nav class="menu">
            <ul>
                <li><a href="orders.php">profile</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="addressbook.php">Address Book</a></li>
                <li><a href="settings.php">Account Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
        <section id="orders" class="order-history">
            <!-- Display user's order history -->
            <h2 class="section-title">Order History</h2>
            <!-- Placeholder content -->
            <ul class="order-list">
                <li>
                    <strong>Order ID:</strong> 12345<br>
                    <strong>Date:</strong> 2022-05-01<br>
                    <strong>Status:</strong> Shipped<br>
                    <strong>Total Amount:</strong> $100.00
                </li>
                <!-- Additional order entries -->
            </ul>
        </section>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>