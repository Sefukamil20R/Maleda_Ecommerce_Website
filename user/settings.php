<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header('Location: ../login.php');
    exit;
}

// Include the database connection file
include '../database/db_connect.php';

// Initialize variables to hold user data
$id = $_SESSION['id'];
$user = [];

// Fetch user data from the database
$query = "SELECT email, phone, address, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update email if changed
    $new_email = $_POST['new_email'] ?? $user['email']; // Default to current email if not provided
    if ($new_email !== $user['email']) {
        $query = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_email, $id);
        if ($stmt->execute()) {
            // Update user variable with new email
            $user['email'] = $new_email;
        } else {
            echo "Error updating email: " . $stmt->error;
        }
    }

    // Update password if changed
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_password, $id);
        if (!$stmt->execute()) {
            echo "Error updating password: " . $stmt->error;
        }
    }

    // Handle profile picture update if provided
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "../images/profilepic/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $query = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $target_file, $id);
            if ($stmt->execute()) {
                // Update user variable with new profile picture path
                $user['profile_picture'] = $target_file;
            } else {
                echo "Error updating profile picture: " . $stmt->error;
            }
        } else {
            echo "Error uploading profile picture.";
        }
    }
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="settings.php">Account settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Account Settings Form -->
        <section id="settings" class="account-settings">
            <h2 class="section-title">Account Settings</h2>
            <form action="settings.php" method="post" class="change-password-form" enctype="multipart/form-data">
                <label for="new_email">New Email:</label>
                <input type="email" id="new_email" name="new_email" value="<?php echo htmlspecialchars($user['email']); ?>" class="email-input">

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="password-input">

                <label for="profile_picture">New Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                <button type="submit" class="btn">Update Account</button>
            </form>
        </section>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>