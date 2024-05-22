<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require 'db_connect.php';

// Fetch products from database
$sql = "SELECT id, title, price, quantity, image FROM products WHERE id BETWEEN 6 AND 26";
$result = $conn->query($sql);

// Check if query was successful
if ($result === false) {
    // Output the SQL error for debugging purposes
    die('Error: ' . $conn->error);
}

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert absolute file path to relative URL
        $row['image'] = str_replace('C:\\xampp\\htdocs\\Maleda\\project\\Maleda_Ecommerce_Website', '', $row['image']);
        $row['image'] = str_replace('\\', '/', $row['image']); // Replace backslashes with forward slashes
        $products[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($products);
?>
