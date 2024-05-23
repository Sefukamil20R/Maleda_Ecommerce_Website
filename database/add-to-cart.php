<?php
global $conn;
require 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // If not, redirect to the login page
    header('Location: ../login.php');

    exit;
}
// Get the product ID and quantity from the query parameters
$product_id = $_GET['productId'];
$quantity = $_GET['quantity'];

// Fetch product from database
$sql = "SELECT id, title, price, quantity, image FROM Products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Check if the cart cookie exists
if (!isset($_COOKIE['cart'])) {
    $cart = array();
} else {
    // If the cart cookie exists, decode it back into an array
    $cart = json_decode($_COOKIE['cart'], true);
}

// Add the product and quantity to the cart
$cart[$product_id] = array('product' => $product, 'quantity' => $quantity);

// Encode the cart back into a JSON string and save it in a cookie
setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day

// Send a response back to the client
header('Content-Type: application/json');
echo json_encode(array('status' => 'success', 'message' => 'Product added to cart'));
?>