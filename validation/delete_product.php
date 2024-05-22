<?php
// Include your database connection file
global $conn;
require '../database/db_connect.php';

// Get the product id from the URL
$product_id = $_GET['id'];

// Prepare a DELETE SQL query
$sql = "DELETE FROM Products WHERE id = ?";

// Initialize a statement for the query
$stmt = $conn->prepare($sql);

// Bind the product id to the statement
$stmt->bind_param("i", $product_id);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to the product list page if the deletion was successful
    header("Location: ../admin/product.php");
} else {
    // Print an error message if the deletion failed
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>