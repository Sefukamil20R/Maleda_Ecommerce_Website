<?php require 'includes/header.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Roboto:ital,wght@0,100;1,300;1,500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/display.css">
    <link rel="stylesheet" href="CSS/footer-style.css" />
    <link rel="stylesheet" href="CSS/header-style.css" />
</head>
<body>
    <div id="product-list"></div>
    <button id="view-cart-button" onclick="viewCart()">View Your Cart</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('database/display.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Fetched data:', data);  // Log fetched data
                    const productList = document.getElementById('product-list');
                    if (!productList) {
                        console.error("Element with id 'product-list' not found.");
                        return;
                    }

                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('item');
                        productItem.id = `product-${product.id}`;
                        productItem.innerHTML = `
                            <img src="${product.image}" alt="${product.title}">
                            <div class="description">
                                <h3>${product.title}</h3>
                                <span class="price">$${product.price}</span>
                            </div>
                            <button onclick="promptForQuantity(${product.id})">Add To Cart</button>
                        `;
                        productList.appendChild(productItem);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));

            updateCartCount();
        });

        function promptForQuantity(productId) {
            var quantityInput = prompt('Enter quantity:', '1');
            var quantity = parseInt(quantityInput, 10);

            if (isNaN(quantity) || quantity < 1) {
                alert('Please enter a valid quantity.');
                return;
            }

            addToCart(productId, quantity);
        }

        function addToCart(productId, quantity) {
            var productContainer = document.getElementById(`product-${productId}`);
            var productName = productContainer.querySelector('.description h3').innerText;
            var productDescription = productContainer.querySelector('.description span').innerText;
            var productPriceText = productContainer.querySelector('.description span.price').innerText;
            var productPrice = parseFloat(productPriceText.replace('$', ''));
            var productImage = productContainer.querySelector('img').src;

            var cart = JSON.parse(localStorage.getItem('cart')) || {};
            
            if (cart[productId]) {
                cart[productId].quantity += quantity;
            } else {
                cart[productId] = { productName, productDescription, productPrice, quantity, productImage };
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Product added to cart');
            updateCartCount();
        }

        function updateCartCount() {
            var cart = JSON.parse(localStorage.getItem('cart')) || {};
            var totalQuantity = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
            document.querySelector('.totalQuantity').innerText = totalQuantity;
        }

        function viewCart() {
            window.location.href = 'cart.php';
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
            gap: 20px;
        }

        #product-list .item {
            flex: 1 1 calc(25% - 20px); 
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

        #product-list .item:hover {
            transform: translateY(-10px);
        }

        #product-list .item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        #product-list .item .description {
            text-align: center;
        }

        #product-list .item .description h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2em;
            color: #333;
            margin-bottom: 5px;
        }

        #product-list .item .description .price {
            font-family: 'Roboto', sans-serif;
            font-size: 1em;
            color: #777;
        }

        #product-list .item button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #product-list .item button:hover {
            background-color: #0056b3;
        }

        #view-cart-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        #view-cart-button:hover {
            background-color: #218838;
        }

        @media (max-width: 1200px) {
            #product-list .item {
                flex: 1 1 calc(33.333% - 20px); 
            }
        }

        @media (max-width: 900px) {
            #product-list .item {
                flex: 1 1 calc(50% - 20px); 
            }
        }

        @media (max-width: 600px) {
            #product-list .item {
                flex: 1 1 100%; 
            }
        }
    </style>
    <?php require 'includes/footer.php'; ?>
</body>
</html>
