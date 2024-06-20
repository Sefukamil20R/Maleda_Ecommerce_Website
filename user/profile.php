<?php
global $conn;
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header('Location: ../login.php');
    exit;
}

// Include the database connection file
include '../database/db_connect.php';

// Check if the database connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the user ID from the session
$id = $_SESSION['id'];

// Fetch user data from the database
$query = "SELECT email, phone, address FROM Users WHERE id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../CSS/header-style.css">
    <link rel="stylesheet" href="../CSS/user_dashboard.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>User Dashboard</h1>
        <!-- Navigation Menu -->
        <nav class="menu">
            <ul>
                <li><a href="myorder.php">Orders</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="settings.php">Account settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Profile Information -->
        <section id="profile" class="profile">
            <!-- Display user's profile information -->
            <h2 class="section-title">Profile Information</h2>
            <div class="profile-info">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            </div>
        </section>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>
