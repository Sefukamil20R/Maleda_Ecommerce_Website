<?php
global $conn;
$titleErr = $priceErr = $quantityErr = $imageErr = "";
$title = $price = $quantity = $image = "";

require '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = $_POST["title"];
    }

    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    } else {
        $price = $_POST["price"];
        if (!is_numeric($price) || $price < 0) {
            $priceErr = "Invalid price";
        }
    }

    if (empty($_POST["quantity"])) {
        $quantityErr = "Quantity is required";
    } else {
        $quantity = $_POST["quantity"];
        if (!is_numeric($quantity) || $quantity < 0) {
            $quantityErr = "Invalid quantity";
        }
    }

    if ($_FILES["image"]["error"] == UPLOAD_ERR_NO_FILE) {
        $imageErr = "Image is required";
    } else {
        $image = $_FILES["image"];
        $imageName = basename($image["name"]);
        $imageTmpName = $image["tmp_name"];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $imageName = uniqid() . '.' . $imageType;
        if (getimagesize($imageTmpName) !== false && in_array($imageType, ["png", "jpeg", "jpg"])) {
            $imageDirectory = dirname(__DIR__) . '/images/products';

            if (!is_dir($imageDirectory)) {
                die('The directory does not exist');
            } elseif (!is_writable($imageDirectory)) {
                die('The directory is not writable');
            }
            $imageDestination = $imageDirectory . '/' . $imageName;
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                $image = $imageDestination;
            } else {
                $imageErr = "Failed to upload image.";
            }
        } else {
            $imageErr = "Invalid file type. Only PNG, JPEG, and JPG files are allowed.";
            
        }
    }

    if (empty($titleErr) && empty($priceErr) && empty($quantityErr) && empty($imageErr)) {
        $sql = "INSERT INTO Products (title, price, quantity, image, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        session_start();
        $user_id = $_SESSION["id"];
        $stmt->bind_param("sdisi", $title, $price, $quantity, $image, $user_id);
        $stmt->execute();

        echo "New product added successfully";
    }
    else{
        echo "There was an error uploading your file.";
    }


}


