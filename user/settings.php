<?php
// Assuming you have a database connection file
include '../database/db_connect.php';

// Start the session
session_start();

// Get the user ID from the session
$id = $_SESSION['id'];

// Fetch user data from the database
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
    <meta charset="UTF-8" />
    <title>Account Settings</title>
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/profile.css">
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
                <li><a href="addressbook.php">Address Book</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
        <section id="settings" class="account-settings">
            <h2 class="section-title">Account Settings</h2>
            <form action="profile.php" method="post" class="change-password-form" enctype="multipart/form-data">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="password-input">
                <label for="new_email">New Email:</label>
                <input type="email" id="new_email" name="new_email" class="email-input" value="<?php echo htmlspecialchars($user['email']); ?>">
                <label for="new_phone">New Phone:</label>
                <input type="text" id="new_phone" name="new_phone" class="phone-input" value="<?php echo htmlspecialchars($user['phone']); ?>">
                <label for="new_address">New Address:</label>
                <input type="text" id="new_address" name="new_address" class="address-input" value="<?php echo htmlspecialchars($user['address']); ?>">
                <button type="submit" class="btn">Update Account</button>
            </form>
            <form action="../signup.php" method="post" class="delete-account-form">
                <button type="submit" name="delete_account" class="btn delete-account">Delete Account</button>
            </form>
        </section>
        <?php include '../includes/footer.php'; ?>
</body>

</html>