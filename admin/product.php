<?php
global $conn;
include 'session_check.php';
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
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/search-bar.css">
    <link rel="stylesheet" href="../CSS/product-listing.css">

	<title>Maleda</title>
</head>
<body>
    <?php include '../includes/header.php' ;?>

    
	<section id="content">
        <?php include '../includes/admin_sidebar.php'; ?>

        <main>
            <div class="search-bar">
                <form>
                    <input id="search" type="search" placeholder="Search..." autofocus required />
                    <button class="search-button" type="submit">Go</button>
                </form>
                <a href="add_product.php">
                    <button class="add-product-btn">
                        Add New Product
                    </button>
                </a>
            </div>

            <div class="product-listing">
                <?php
                // Connect to your database
                require '../database/db_connect.php';

                // Write a SQL query to fetch all products
                $sql = "SELECT * FROM Products";

                // Execute the query and store the result
                $result = $conn->query($sql);

                // Check if the query returned any products
                if ($result->num_rows > 0) {
                    // Loop through the result and generate the HTML for each product
                    while($product = $result->fetch_assoc()) {
                        ?>
                        <div class="product-item">
                            <img src="<?php echo '/images/products/' . basename($product['image']) ?>" alt="Product Image">
                            <h2><?php echo $product['title']; ?></h2>
                            <p>Price: $<?php echo $product['price']; ?></p>
                            <p>Quantity: <?php echo $product['quantity']; ?></p>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>">
                                <button class="edit-btn">
                                    Edit
                                </button>
                            </a>
                            <a href="../validation/delete_product.php?id=<?php echo $product['id']; ?>">
                                <button class="delete-btn">
                                    Delete
                                </button>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    echo "No products found";
                }

                // Close the database connection
                $conn->close();
                ?>

            </div>


		</main>
		<!-- MAIN -->
        <?php include '../includes/footer.php' ;?>
	</section>
	<!-- CONTENT -->
	

	<script src="../js/script.js"></script>
</body>
</html>