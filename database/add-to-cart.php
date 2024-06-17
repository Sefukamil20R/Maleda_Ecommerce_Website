<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    echo json_encode(['redirect' => 'login.php']);
    exit();
}

$productId = $_GET['productId'];
$productTitle = $_GET['productTitle'];
$productPrice = $_GET['productPrice'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$product = ['id' => $productId, 'title' => $productTitle, 'price' => $productPrice];

if (!in_array($product, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $product;
}

echo json_encode(['cart_count' => count($_SESSION['cart'])]);
?>