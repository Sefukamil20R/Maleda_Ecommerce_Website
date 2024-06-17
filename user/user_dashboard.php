<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

// Fetch user data (if needed)
// Include database connection
include '../database/db_connect.php';

// Fetch user data from the database (for displaying profile info)
$id = $_SESSION['id'];
$query = "SELECT email, phone, address FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Handmade Crafts</title>
    <link rel="stylesheet" href="../CSS/header-style.css">
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" href="../CSS/user_dashboard.css"> <!-- Create this stylesheet -->
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['email']); ?></h1>

        <!-- Navigation Menu -->
        <nav class="menu">
            <ul>
                <li><a href="products.php">Products</a></li> <!-- Link to browse products -->
                <li><a href="cart.php">Cart</a></li> <!-- Link to view and manage cart -->
                <li><a href="myorder.php">Orders</a></li> <!-- Link to view orders -->
                <li><a href="profile.php">Profile</a></li> <!-- Link to edit profile -->
                <li><a href="../logout.php">Logout</a></li> <!-- Link to logout -->
            </ul>
        </nav>

        <!-- Content Area for Dashboard -->
        <div class="dashboard-content">
            <!-- You can add more sections here, like products, cart, orders, etc. -->
            <section id="welcome">
                <h2>Welcome to maleda Handmade Crafts!</h2>
                <p>Explore our collection of handmade products and enjoy your shopping experience.</p>
            </section>





        </div>
        </section>
    </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>