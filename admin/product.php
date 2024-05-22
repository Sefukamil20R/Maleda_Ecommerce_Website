<?php
global $conn;
include 'session_check.php';

$product_id = $_GET['id'];

require '../database/db_connect.php';

$sql = "SELECT * FROM Products";

$stmt = $conn->prepare($sql);

$stmt->execute();

// Get the result
$result = $stmt->get_result();

$products = $result->fetch_all(MYSQLI_ASSOC);


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
    <link rel="stylesheet" href="../CSS/search-box.css">


	<title>Maleda</title>
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
                                <a class="active" href="#">Products</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <ul class="box-info">
                    <li>
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
						<h3>100</h3>
						<p style="margin-left: 0;">Products</p>
					</span>
                    </li>
                    <li>
                        <i class='bx bxs-group' ></i>
                        <span class="text">
						<h3>50 Artisans</h3>
						<p style="margin-left: 0;">Visitors</p>
					</span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle' ></i>
                        <span class="text">
						<h3>$2543</h3>
						<p style="margin-left: 0;">Total Sales</p>
					</span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Customer Data</h3>
                            <form class="search-box" action="customer.php" method="get">
                                <input type="text" name="query" placeholder="Search...">
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>price</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>

                                        <td><?php echo $product['id']; ?></td>
                                        <td><img src="<?php echo '/images/products/' . basename($product['image']) ?>" alt="Product Image" width="300px" height="300px"></td>
                                        <td><?php echo $product['title']; ?></td>
                                        <td><?php echo $product['price']; ?></td>
                                        <td><?php echo $product['quantity']; ?></td>
                                        <td><a href="edit_product.php?id=<?php echo $product['id']; ?>"><i class="fas fa-edit"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
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