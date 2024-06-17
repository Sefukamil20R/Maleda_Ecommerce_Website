<?php
global $conn;
include 'session_check.php';
require '../database/db_connect.php';

// Fetch products from the database
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);


$conn->close();


$filename = "products.csv";


$f = fopen('php://memory', 'w');


fputcsv($f, array_keys($products[0]));


foreach ($products as $product) {
    fputcsv($f, $product);
}

// Go back to the start of the stream
fseek($f, 0);

// Set the headers to trigger download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Output the data stream to the browser
fpassthru($f);
exit;