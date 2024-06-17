<?php
global $conn;
include 'session_check.php';
require '../database/db_connect.php';

$sql = "SELECT DATE_FORMAT(o.order_date, '%Y-%m') as month, COUNT(DISTINCT o.user_id) as users, COUNT(*) as orders, SUM(o.total_amount) as total_income, AVG(o.total_amount) as avg_spending
        FROM Orders o
        INNER JOIN Users u ON o.user_id = u.id
        GROUP BY month
        ORDER BY month DESC";
$result = $conn->query($sql);

$orders = $result->fetch_all(MYSQLI_ASSOC);
// Execute the SQL queries for the requested metrics
$sqlQueries = [
    "Total Number of Users" => "SELECT COUNT(*) as total_users FROM Users",
    "Total Number of Orders" => "SELECT COUNT(*) as total_orders FROM Orders",
    "Total Sales Amount" => "SELECT SUM(total_amount) as total_sales FROM Orders",
    "Average Order Value" => "SELECT AVG(total_amount) as avg_order_value FROM Orders",
    "Number of Orders per User" => "SELECT user_id, COUNT(*) as orders_per_user FROM Orders GROUP BY user_id",
    "Sales by Status" => "SELECT status, SUM(total_amount) as sales_by_status FROM Orders GROUP BY status",
    "Top Selling Products" => "SELECT product_id, SUM(quantity) as total_quantity_sold FROM OrderItems GROUP BY product_id ORDER BY total_quantity_sold DESC",
    "Total Quantity of Products Sold" => "SELECT SUM(quantity) as total_quantity_sold FROM OrderItems",
    "Sales by Month" => "SELECT DATE_FORMAT(order_date, '%Y-%m') as month, SUM(total_amount) as sales_by_month FROM Orders GROUP BY month",
];

// Initialize the report array
$report = [];

// Execute each query and add the result to the report
foreach ($sqlQueries as $metric => $sql) {
    $result = $conn->query($sql);
    $report[$metric] = $result->fetch_all(MYSQLI_ASSOC);
}

// Close the database connection
$conn->close();

// Define the CSV file name
$filename = "orders_report.csv";

// Open the output stream
$f = fopen('php://memory', 'w');

// Put the header
fputcsv($f, array_keys($orders[0]));

// Put the data
foreach ($orders as $order) {
    fputcsv($f, $order);
}

// Go back to the start of the stream
fseek($f, 0);

// Set the headers to trigger download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Output the data stream to the browser
fpassthru($f);
$filename = "report.csv";

// Open the output stream
$f = fopen('php://memory', 'w');

// Write the report to the CSV file
foreach ($report as $metric => $data) {
    // Write the metric name
    fputcsv($f, [$metric]);

    // Write the data
    foreach ($data as $row) {
        fputcsv($f, $row);
    }

    // Add an empty line between metrics
    fputcsv($f, []);
}

// Go back to the start of the stream
fseek($f, 0);

// Set the headers to trigger download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Output the data stream to the browser
fpassthru($f);
exit;