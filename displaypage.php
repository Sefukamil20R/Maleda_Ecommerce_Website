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
            fetch('database/cart-count.php')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.totalQuantity').innerText = data.cart_count;
                })
                .catch(error => console.error('Error fetching cart count:', error));
        }
    </script>
    <?php require 'includes/footer.php'; ?>
</body>
</html>
