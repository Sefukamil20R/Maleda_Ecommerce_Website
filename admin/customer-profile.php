<?php
global $conn;
include 'session_check.php';

$customer_id = $_GET['id'];

require '../database/db_connect.php';

$sql = "SELECT * FROM Users WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $customer_id);

$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the customer's details
if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
} else {
    echo "No customer found with id: " . $customer_id;
    exit;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="../CSS/content-sidebar.css">
    <link rel="stylesheet" href="../CSS/header-style.css">
    <link rel="stylesheet" href="../CSS/footer-style.css">

    <title>Customer Profile</title>
</head>
<body>
<?php include '../includes/header.php' ;?>

<section id="content">
    <?php include '../includes/admin_sidebar.php'; ?>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="#">Customer Profile</a>
                    </li>
                </ul>
            </div>
        </div>


        <ul class="box-info">
            <li>
                <i class='bx bxs-id-card' ></i>
                <span class="text">
						<h3>ID</h3>
						<p><?php echo $customer['id']; ?></p>
					</span>
            </li>
            <li>
                <i class='bx bxs-envelope' ></i>
                <span class="text">
						<h3>Email</h3>
						<p><?php echo $customer['email']; ?></p>
					</span>
            </li>
            <li>
                <i class='bx bxs-map' ></i>
                <span class="text">
						<h3>Address</h3>
						<p><?php echo $customer['address']; ?></p>
					</span>
            </li>
            <li>
                <i class='bx bxs-phone-call' ></i>
                <span class="text">
						<h3>Phone</h3>
						<p><?php echo $customer['phone']; ?></p>
					</span>
            </li>
        </ul>
    </main>

    <?php include '../includes/footer.php' ;?>
</section>

<script src="../js/script.js"></script>
</body>
</html>