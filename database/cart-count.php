<?php
session_start();

$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo json_encode(['cart_count' => $cart_count]);
?>
