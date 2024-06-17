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
function makeAdmin($user_id) {
    
    global $conn;
    $sql = "UPDATE Users SET is_admin = 1 WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo "User promoted to admin successfully.";
        } else {
            echo "Error: Could not execute the query: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the query: " . $conn->error;
    }
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
<?php  include '../includes/loggedin-header.php' ; ?>

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


        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                    <i class='bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date Order</th>
                        <th>Status</th>
                        <th>Total cost</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php' ;?>
</section>

<script src="../js/script.js"></script>
</body>
</html>