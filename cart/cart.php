<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Cart Page</title>
    <link rel="stylesheet" href="../HTML/style.css">
</head>
<body>
    <header>
        <h1>Game Store</h1>
        <nav>
            <a href="../HTML/index.html">Home</a>
            <a href="../HTML/product.html">Product Details</a>
            <a href="../HTML/login.html">Login</a>
        </nav>
    </header>

    <main>
        <h2>Your Cart</h2>
        <section class="cart-items" id="CartItems">
            <?php
            $total = 0;

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $index => $item) {
                    $price = (float)$item['price'];
                    $quantity = (int)$item['quantity'];
                    $subtotal = $price * $quantity;
                    $total += $subtotal;

                    echo "<div class='cart-item'>";
                    echo '<img src="../HTML/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['title']) . '" class="game-image">';
                    echo "<h3>" . htmlspecialchars($item['title']) . "</h3>";
                    echo "<p>Price: \$" . number_format($price, 2) . "</p>";
                    echo "<label>Quantity: 
                            <input type='number' value='{$quantity}' min='1' onchange='updateQuantity({$index}, this.value)'>
                          </label>";
                    echo "<button onclick='removeItem({$index})'>Remove</button>";
                    echo "<p>Subtotal: \$" . number_format($subtotal, 2) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </section>
        <div class="cart-total">
            <h3>Total: $<span id="totalPrice"><?php echo number_format($total, 2); ?></span></h3>
            <button onclick="checkout()">Proceed to Checkout</button>
        </div>
    </main>

    <script>
        function updateQuantity(index, quantity) {
    // Submit form data (triggers page reload after PHP updates)
       const form = document.createElement('form');
       form.method = 'POST';
       form.action = 'update_cart.php';
    
       const inputIndex = document.createElement('input');
       inputIndex.type = 'hidden';
       inputIndex.name = 'index';
       inputIndex.value = index;
    
       const inputQty = document.createElement('input');
       inputQty.type = 'hidden';
       inputQty.name = 'quantity';
       inputQty.value = quantity;
    
       form.appendChild(inputIndex);
       form.appendChild(inputQty);
       document.body.appendChild(form);
       form.submit();
}

        function removeItem(index) {
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `index=${index}`
            })
            .then(response => location.reload());
        }

        function checkout() {
            alert('Proceeding to checkout!');
            // window.location.href = 'checkout.php';
        }
    </script>
</body>
</html>