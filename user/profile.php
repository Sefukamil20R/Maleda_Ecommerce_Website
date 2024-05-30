<?php
// Assuming you have a database connection file
include '../database/db_connect.php';

// Start the session
session_start();

// Get the user ID from the session
$id = $_SESSION['id'];

// Fetch user data from the database
$query = "SELECT email, phone, address, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_account'])) {
        // Delete user from the database
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Destroy session and redirect to login
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $new_email = $_POST['new_email'] ?? null;
        $new_password = !empty($_POST['new_password']) ? password_hash($_POST['new_password'], PASSWORD_BCRYPT) : null;
        $new_phone = $_POST['new_phone'] ?? null;
        $new_address = $_POST['new_address'] ?? null;
        $profile_picture = !empty($_FILES['profile_picture']['name']) ? $_FILES['profile_picture']['name'] : null;

        // Update user information in the database
        if (!empty($new_email)) {
            $query = "UPDATE users SET email = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_email, $id);
            $stmt->execute();
        }
        if (!empty($new_password)) {
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_password, $id);
            $stmt->execute();
        }
        if (!empty($new_phone)) {
            $query = "UPDATE users SET phone = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_phone, $id);
            $stmt->execute();
        }
        if (!empty($new_address)) {
            $query = "UPDATE users SET address = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_address, $id);
            $stmt->execute();
        }
        if (!empty($profile_picture)) {
            $target_dir = "../images/profilepic/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

            $query = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $profile_picture, $id);
            $stmt->execute();
        }
        // Refresh user data
        $query = "SELECT email, phone, address, profile_picture FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Profile</title>
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
                <li><a href="settings.php">Account Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
        <section id="profile" class="profile">
            <h2 class="section-title">Profile Information</h2>
            <div class="profile-info">
                <img src="../images/profilepic/<?php echo htmlspecialchars($user['profile_picture'] ?? 'default.jpg'); ?>" alt="Profile Picture" class="profile-picture">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? ''); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address'] ?? ''); ?></p>
            </div>
        </section>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>