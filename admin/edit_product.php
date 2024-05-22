<?php
// Include your database connection file
global $conn;
require '../database/db_connect.php';

// Get the product id from the URL
$product_id = $_GET['id'];

// Prepare a SELECT SQL query
$sql = "SELECT * FROM Products WHERE id = ?";

// Initialize a statement for the query
$stmt = $conn->prepare($sql);

// Bind the product id to the statement
$stmt->bind_param("i", $product_id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if a product was found
if ($result->num_rows > 0) {
    // Get the product details
    $product = $result->fetch_assoc();
} else {
    // Print an error message if no product was found
    echo "No product found with id: " . $product_id;
    exit;
}

// Close the statement
$stmt->close();

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the new product details from the form
    $title = $_POST['title'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare an UPDATE SQL query
    $sql = "UPDATE Products SET title = ?, price = ?, quantity = ? WHERE id = ?";

    // Initialize a statement for the query
    $stmt = $conn->prepare($sql);

    // Bind the new product details to the statement
    $stmt->bind_param("siii", $title, $price, $quantity, $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the product list page if the update was successful
        header("Location: ../admin/product.php");
    } else {
        // Print an error message if the update failed
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!-- The form for editing the product details -->


<?php
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

    <title>Maleda</title>
</head>
<body>
<?php include '../includes/header.php' ;?>


<section id="content">
    <?php include '../includes/admin_sidebar.php'; ?>

    <main>
        <div class="form-container">
            <div class="login-form">
                <form method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $product['title']; ?>" required>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

                    <input type="submit" value="Update">
                </form>

            </div>
            <div class="pic">
                <img src="../images/ph.png"  alt=""/>
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