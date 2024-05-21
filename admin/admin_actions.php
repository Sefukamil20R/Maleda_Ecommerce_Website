<?php
require '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Sanitize inputs
    $title = isset($_POST['title']) ? $conn->real_escape_string($_POST['title']) : '';
    $price = isset($_POST['price']) ? $conn->real_escape_string($_POST['price']) : 0;
    $quantity = isset($_POST['quantity']) ? $conn->real_escape_string($_POST['quantity']) : 0;
    $image = isset($_POST['image']) ? $conn->real_escape_string($_POST['image']) : '';
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : 0;

    if ($action == 'add') {
        $sql = "INSERT INTO Products (title, price, quantity, image) VALUES ('$title', '$price', '$quantity', '$image')";
    } elseif ($action == 'edit') {
        $updates = [];
        if (!empty($title)) $updates[] = "title='$title'";
        if (!empty($price)) $updates[] = "price='$price'";
        if (!empty($quantity)) $updates[] = "quantity='$quantity'";
        if (!empty($image)) $updates[] = "image='$image'";
        $updates = implode(', ', $updates);
        $sql = "UPDATE Products SET $updates WHERE id=$id";
    } elseif ($action == 'remove') {
        $sql = "DELETE FROM Products WHERE id=$id";
    } else {
        die("Invalid action: $action");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Action $action completed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
