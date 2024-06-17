

    <?php
    session_start();
    include '../database/db_connect.php';

    // Check if the user is logged in, if not redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../login.php");
        exit();
    }

    // Check if the product ID is set
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Fetch product details from the database
        $query = "SELECT id, title, price FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            // Initialize the cart if not already
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Add product to the cart
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];
            } else {
                // Increment the quantity if the product is already in the cart
                $_SESSION['cart'][$product_id]['quantity'] += 1;
            }
        }
    }

    // Redirect to the products page or cart page
    header("location: cart.php");
    exit();
