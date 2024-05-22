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
            <div class="search-bar">
                <form>
                    <input id="search" type="search" placeholder="Search..." autofocus required />
                    <button class="search-button" type="submit">Go</button>
                </form>
                <a href="add_product.php">
                    <button class="add-product-btn">
                        Add New Product
                    </button>
                </a>
            </div>


		</main>
		<!-- MAIN -->
        <?php include '../includes/footer.php' ;?>
	</section>
	<!-- CONTENT -->
	

	<script src="../js/script.js"></script>
</body>
</html>