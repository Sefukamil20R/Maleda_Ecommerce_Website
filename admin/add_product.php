<?php
include 'session_check.php';
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
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/search-bar.css">

    <title>Maleda</title>
</head>
<body>
<?php include '../includes/header.php' ;?>


<section id="content">
    <?php include '../includes/admin_sidebar.php'; ?>

    <main>
        <div class="form-container">
            <div class="login-form">
                <form action="../validation/product_validation.php" method="post" enctype="multipart/form-data">
                    <h1>Add Product</h1>
                    <hr />
                    <p>Artisan Elegance, Shipped to You.</p>
                    <label for="title">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="Enter product title"
                    />

                    <label for="price">Price</label>
                    <input
                        id="price"
                        name="price"
                        type="number"
                        step="0.01"
                        placeholder="Enter product price"
                    />

                    <label for="quantity">Quantity</label>
                    <input
                        id="quantity"
                        name="quantity"
                        type="number"
                        placeholder="Enter product quantity"
                    />

                    <label for="image">Image</label>
                    <input
                        id="image"
                        name="image"
                        type="file"
                    />
                    <input type="submit" value="Add Product">

                </form>
            </div>
            <div class="pic">
                <img src="../images/ph.png"  alt=""/>
            </div>
        </div>
    </main>
    <!-- MAIN -->
    <?php include '../includes/footer.php' ;?>
</section>
<!-- CONTENT -->


<script src="../js/script.js"></script>
</body>
</html>