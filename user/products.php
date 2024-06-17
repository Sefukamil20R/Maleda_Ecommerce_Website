<?php
// Include database connection
include '../database/db_connect.php';

// Initialize the $products variable as an empty array
$products = [];

// Fetch products from the database with correct column names
$query = "SELECT id, title, quantity, price, image FROM products";
$result = $conn->query($query);

// Check if there are any products and fetch them into the $products array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/footer-style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/login.css" />
    <link rel="stylesheet" href="../CSS/header-style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Our Products</h1>
        <div class="products-list">

            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                    <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                    <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
                    <a href="add_to_cart.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>