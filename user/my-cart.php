<?php
global $conn;
include 'session_check.php';



require '../database/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php?redirect_to=cart.php');
    exit();
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="../CSS/content-sidebar.css">
    <link rel="stylesheet" href="../CSS/header-style.css">
    <link rel="stylesheet" href="../CSS/footer-style.css">

    <title>Customer Profile</title>
</head>
<body>
<?php  include '../includes/loggedin-header.php' ; ?>

<section id="content">
    <?php include '../includes/user-sidebar.php'; ?>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="#">Customer Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cart-items">
            <?php if (empty($cart_items)) { ?>
                <p>Your cart is empty.</p>
            <?php } else {
                foreach ($cart_items as $item) {
                    echo "<div class='cart-item'>
                        <h2>".$item['title']."</h2>
                        <p>$".$item['price']."</p>
                      </div>";
                }
            } ?>
        </div>



    </main>

    <?php include '../includes/footer.php' ;?>
</section>

<script src="../js/script.js"></script>
</body>
</html>