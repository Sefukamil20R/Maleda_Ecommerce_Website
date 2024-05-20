<?php
require 'db_connect.php';

// Create database
$dbname = "myDatabase";
$sql = "DROP DATABASE IF EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error dropping database: " . $conn->error);
}

$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db($dbname);

// sql to create table
$sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL
    )";


if ($conn->query($sql) === TRUE) {
    echo "Table myTable created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
// sql to create Products table
$sql = "CREATE TABLE Products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT(6) NOT NULL,
    image VARCHAR(255) NOT NULL,
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES Users(id)
    )";
if ($conn->query($sql) === TRUE) {
    echo "Table Products created successfully";
} else {
    die("Error creating Products table: " . $conn->error);
}

$conn->close();
?>