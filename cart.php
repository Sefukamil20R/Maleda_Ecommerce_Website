
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
</body>
</html>
