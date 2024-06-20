<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="CSS/cart.css">
</head>
<body>
    <div id="cartItems"></div>
    <div id="totalPrice"></div>
    <div id="deliveryFee"></div>
    <button onclick="checkout()">Checkout</button>
    


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // localStorage.removeItem('cart');

            var total = 0;
            var delivery = 0;
            var cart = JSON.parse(localStorage.getItem("cart")) || {};
            var cartItemsContainer = document.getElementById("cartItems");
            var totalPriceElement = document.getElementById("totalPrice");
            var deliveryFeeElement = document.getElementById("deliveryFee");

            if (Object.keys(cart).length === 0) {
                cartItemsContainer.innerHTML = "<p>Your cart is empty. Choose any products you want from the products page.</p>";
            } else {
                for (var productId in cart) {
                    if (cart.hasOwnProperty(productId)) {
                        var item = cart[productId];
                        var itemElement = document.createElement("div");
                        itemElement.classList.add("cart-item");
                        itemElement.innerHTML = `
                            <img src="${item.productImage}" alt="${item.productName}" width="100" height="100">
                            <div class="item-details">
                                <p>${item.productName}</p>
                                <p>Price: $${item.productPrice}</p>
                                <p>Quantity: ${item.quantity}</p>
                            </div>
                        `;
                        cartItemsContainer.appendChild(itemElement);

                        total += item.productPrice * item.quantity;
                    }
                }
                delivery = total * 0.05;
                totalPriceElement.innerText = "Total price: $" + total.toFixed(2);
            }
        });

        async function checkout() {
            var cart = JSON.parse(localStorage.getItem("cart")) || {};
            var lineItems = [];

            for (var productId in cart) {
                if (cart.hasOwnProperty(productId)) {
                    var item = cart[productId];
                    lineItems.push({
                        price: item.productPrice,
                        name: item.productName,
                        quantity: item.quantity
                    });
                }
            }
            
            try {
                const response = await fetch('stripe/checkout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ lineItems })
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.href = result.url;
                } else {
                    alert(result.error);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during checkout. Please try again.');
            }
        }
    </script>
     <style>
    /* Basic reset and box-sizing */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Container for cart items */
#cartItems {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px;
    gap: 20px;
}

/* Style for individual cart item */
.cart-item {
    flex: 1 1 calc(25% - 20px); /* Ensures 4 items per row with 20px gap */
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.cart-item:hover {
    transform: translateY(-10px);
}

/* Style for cart item image */
.cart-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

/* Style for item details */
.item-details {
    text-align: center;
}

.item-details p {
    font-family: 'Roboto', sans-serif;
    font-size: 1em;
    color: #333;
    margin-bottom: 5px;
}

/* Style for total price and delivery fee */
#totalPrice, #deliveryFee {
    text-align: center;
    margin: 20px 0;
    font-family: 'Roboto', sans-serif;
    font-size: 1.2em;
    color: #333;
}

/* Style for checkout button */
button {
    display: block;
    margin: 20px auto;
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive design for smaller screens */
@media (max-width: 1200px) {
    .cart-item {
        flex: 1 1 calc(33.333% - 20px); /* 3 items per row */
    }
}

@media (max-width: 900px) {
    .cart-item {
        flex: 1 1 calc(50% - 20px); /* 2 items per row */
    }
}

@media (max-width: 600px) {
    .cart-item {
        flex: 1 1 100%; /* 1 item per row */
    }
}

    </style>
</body>
</html>
