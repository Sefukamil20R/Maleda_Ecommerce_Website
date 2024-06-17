<?php
global $conn;
include 'session_check.php';

$search_term = isset($_GET['query']) ? $_GET['query'] : '';
$min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? $_GET['max_price'] : PHP_INT_MAX;
$min_quantity = isset($_GET['min_quantity']) && is_numeric($_GET['min_quantity']) ? $_GET['min_quantity'] : 0;
$max_quantity = isset($_GET['max_quantity']) && is_numeric($_GET['max_quantity']) ? $_GET['max_quantity'] : PHP_INT_MAX;

// Get the sort column and direction from the $_GET array. If they're not set, set them to default values.
$sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'id';
$sort_direction = isset($_GET['sort_direction']) && in_array($_GET['sort_direction'], ['asc', 'desc']) ? $_GET['sort_direction'] : 'asc';

require '../database/db_connect.php';

$sql = "SELECT * FROM Products WHERE title LIKE ? AND price BETWEEN ? AND ? AND quantity BETWEEN ? AND ? ORDER BY $sort_column $sort_direction";
$stmt = $conn->prepare($sql);
$search_term = "%$search_term%";
$stmt->bind_param("siiii", $search_term, $min_price, $max_price, $min_quantity, $max_quantity);

$stmt->execute();

// Get the result
$result = $stmt->get_result();

$products = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
$min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? $_GET['max_price'] : '';
$min_quantity = isset($_GET['min_quantity']) && is_numeric($_GET['min_quantity']) ? $_GET['min_quantity'] : '';
$max_quantity = isset($_GET['max_quantity']) && is_numeric($_GET['max_quantity']) ? $_GET['max_quantity'] : '';

$query_params = array(
    'query' => $search_term,
    'min_price' => $min_price,
    'max_price' => $max_price,
    'min_quantity' => $min_quantity,
    'max_quantity' => $max_quantity
);

$query_string = http_build_query($query_params);
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
                                <a class="active" href="#">Products</a>
                            </li>
                        </ul>
                    </div>
                    <div class="right">
                        <a href="add_product.php">Add new Product</a>
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
                            <h3>Product Data</h3>
                            <form class="search-box" action="product.php" method="get">
                                <input type="text" name="query" placeholder="Search...">
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>

                        <div id="filterOptions">
                            <form action="product.php" method="get">

                                <div>
                                    <div>
                                        <label for="min_price">Min Price:</label>
                                        <input type="number" id="min_price" name="min_price" min="0">
                                    </div>
                                    <div>
                                        <label for="max_price">Max Price:</label>
                                        <input type="number" id="max_price" name="max_price" min="0">
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <label for="min_quantity">Min Quantity:</label>
                                        <input type="number" id="min_quantity" name="min_quantity" min="0">
                                    </div>
                                    <div>
                                        <label for="max_quantity">Max Quantity:</label>
                                        <input type="number" id="max_quantity" name="max_quantity" min="0">
                                    </div>
                                </div>

                                <div>
                                    <button type="submit">Apply Filters</button>
                                    <a href="product.php">Remove filter</a>
                                </div>
                            </form>

                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th>ID
                                    <a href="?<?php echo $query_string; ?>&sort_column=id&sort_direction=asc"><i class='bx bx-sort-up'></i></a>
                                    <a href="?<?php echo $query_string; ?>&sort_column=id&sort_direction=desc"><i class='bx bx-sort-down'></i></a>

                                </th>

                                <th>Image</th>
                                <th>Title
                                    <a href="?<?php echo $query_string; ?>&sort_column=title&sort_direction=asc"><i class='bx bx-sort-up'></i></a>
                                    <a href="?<?php echo $query_string; ?>&sort_column=title&sort_direction=desc"><i class='bx bx-sort-down'></i></a>
                                </th>
                                <th>price
                                    <a href="?<?php echo $query_string; ?>&sort_column=price&sort_direction=asc"><i class='bx bx-sort-up'></i></a>
                                    <a href="?<?php echo $query_string; ?>&sort_column=price&sort_direction=desc"><i class='bx bx-sort-down'></i></a>
                                </th>
                                <th>Quantity
                                    <a href="?<?php echo $query_string; ?>&sort_column=quantity&sort_direction=asc"><i class='bx bx-sort-up'></i></a>
                                    <a href="?<?php echo $query_string; ?>&sort_column=quantity&sort_direction=desc"><i class='bx bx-sort-down'></i></a>
                                </th>

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