<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['redirect' => 'login.php']);
    exit();
}

$productId = $_GET['productId'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!in_array($productId, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $productId;
}

echo json_encode(['cart_count' => count($_SESSION['cart'])]);
?>
