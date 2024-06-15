<?php require 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Roboto:ital,wght@0,100;1,300;1,500&display=swap"
    rel="stylesheet" />
    <link rel="stylesheet" href="CSS/display.css">
    <link rel="stylesheet" href="CSS/footer-style.css" />
    <link rel="stylesheet" href="CSS/header-style.css" />
</head>
<body>
    <div class="container">
        <section id="header">
            <h1>MALEDA's PRODUCT LIST</h1>
            <div class="iconCart" onclick="redirectToCart()">
                <img src="CSS/Image/icon.png" />
                <div class="totalQuantity" id="cart-count">0</div>
            </div>
        </section>
        
        <div class="listProduct" id="product-list"></div>
    </div>

    <div class="cart">
        <h2>CART</h2>
        <div class="listCart"></div>
        <div class="buttons">
            <div class="close">CLOSE</div>
            <div class="checkout">
                <a href="checkout.html">CHECKOUT</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('database/display.php')
                .then(response => response.json())
                .then(data => {
                    const productList = document.getElementById('product-list');
                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('item');
                        productItem.innerHTML = `
                            <img src="${product.image}" alt="${product.title}">
                            <h2>${product.title}</h2>
                            <div class="price">$${product.price}</div>
                            <button onclick="addCart(${product.id})">Add To Cart</button>
                        `;
                        productList.appendChild(productItem);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));

            updateCartCount();
        });

        function addCart(productId) {
            fetch(`database/add-to-cart.php?productId=${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        document.getElementById('cart-count').innerText = data.cart_count;
                    }
                })

                .catch(error => console.error('Error adding item to cart:', error));
        }

        function updateCartCount() {
            fetch('database/cart-count.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-count').innerText = data.cart_count;
                })
                .catch(error => console.error('Error fetching cart count:', error));
        }

        function redirectToCart() {
            fetch('database/check-login.php')
                .then(response => response.json())
                .then(data => {
                    if (data.logged_in) {
                        window.location.href = 'cart.php';
                    } else {
                        window.location.href = 'login.php?redirect_to=cart.php';
                    }
                })
                .catch(error => console.error('Error checking login status:', error));
        }
    </script>
</body>
<?php require 'includes/footer.php'; ?>
</html>
