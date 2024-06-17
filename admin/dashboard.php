<?php
global $conn;
include 'session_check.php';
require '../database/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$sql = "SELECT * FROM Orders ORDER BY order_date DESC";
$result = $conn->query($sql);

$orders = $result->fetch_all(MYSQLI_ASSOC);
$sql = "SELECT COUNT(*) as total_orders FROM Orders";
$result = $conn->query($sql);

$order_count = $result->fetch_assoc()['total_orders'];
$sql = "SELECT COUNT(*) as total_users FROM Users";
$result = $conn->query($sql);
$user_count = $result->fetch_assoc()['total_users'];

// SQL query to get the total income
$sql = "SELECT SUM(total_amount) as total_income FROM Orders";
$result = $conn->query($sql);
$total_income = $result->fetch_assoc()['total_income'];
if ($total_income === null) {
   $total_income = 0;
}
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

	<title>Maleda</title>
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
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="download-report.php" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download report</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $order_count?></h3>
						<p>Total Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $user_count?></h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo $total_income?></h3>
						<p>Total Sales</p>
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
								<th>User</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['user_id']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>

						</tbody>
					</table>
				</div>
                <div class="order">
                    <form class="order-form" action="process-form.php" method="post">
                        <label for="receiver">Receiver:</label><br>
                        <input type="email" id="receiver" name="receiver"><br>
                        <label for="subject">Subject:</label><br>
                        <input type="text" id="subject" name="subject"><br>
                        <label for="body">Body:</label><br>
                        <textarea id="body" name="body"></textarea><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>

		</main>
		<!-- MAIN -->
        <?php include '../includes/footer.php' ;?>
	</section>
	<!-- CONTENT -->
	

	<script src="../js/script.js"></script>
</body>
</html>