<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Account Settings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/login.css">
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
                <li><a href="orders.php">Orders</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="addressbook.php">Address Book</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <!-- Account Settings -->
        <section id="settings" class="account-settings">
            <!-- Change password -->
            <h2 class="section-title">Account Settings</h2>
            <form action="profile.php" method="post" class="change-password-form" enctype="multipart/form-data">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="password-input">
                <label for="new_email">New Email:</label>
                <input type="email" id="new_email" name="new_email" class="email-input">
                <!-- Add more fields for other account details -->
                <button type="submit" class="btn">Update Account</button>
            </form>
            <!-- Notification preferences -->
            <h3>Notification Preferences</h3>
            <label><input type="checkbox" name="email_notifications" checked> Email Notifications</label>
            <label><input type="checkbox" name="order_updates" checked> Order Updates</label><br>
            <!-- Delete account button -->
            <button class="btn delete-account">Delete Account</button>
        </section>
        <?php include '../includes/footer.php'; ?>
</body>

</html>