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
    <link rel="stylesheet" href="../CSS/header-style.css">
</head>


<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>User Dashboard</h1>
        <nav class="menu">
            <ul>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="profile.php">profile</a></li>
                <li><a href="settings.php">Account Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Address Book -->
        <section id="address" class="address-book">
            <!-- Display user's shipping addresses -->
            <h2 class="section-title">Address Book</h2>
            <!-- Placeholder content -->
            <ul class="address-list">
                <li>
                    <span>Address 1:</span> 123 Main St, City, Country, Postal Code
                    <!--button class="btn">Edit</!--button>
                    <button class="btn">Delete</button>
                </li>
                <!-- Additional address entries -->
            </ul>
            <!-- Add new address button -->
            <!--button class="btn add-address">Add New Address</!--button-->
        </section>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>