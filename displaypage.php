<!-- display.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="CSS/display.css">
</head>
<body>
    <!-- Your HTML and JavaScript code here -->
    <div class="container">
        <section id="header">
            <h1>MALEDA's PRODUCT LIST</h1>
            <div class="iconCart">
                <img src="CSS/Image/icon.png" />
                <div class="totalQuantity">0</div>
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
                            <img src="http://localhost/Maleda/project/Maleda_Ecommerce_Website/${product.image}" alt="${product.title}">
                            <h2>${product.title}</h2>
                            <div class="price">$${product.price}</div>
                            <button onclick="addCart(${product.id})">Add To Cart</button>
                        `;
                        productList.appendChild(productItem);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });

        function addCart(productId) {
            // Send an AJAX request to addToCart.php with productId
            fetch('database/addToCart.php', {
                method: 'POST',
                body: JSON.stringify({productId: productId}),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                // Handle the response
                console.log('Item added to cart');
                // Update the UI or perform any other actions as needed
            })
            .catch(error => console.error('Error adding item to cart:', error));
        }
    </script>
</body>
</html>