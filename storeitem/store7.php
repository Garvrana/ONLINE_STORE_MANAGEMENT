<?php

if (!isset($_GET['username']) || !isset($_GET['role'])) {
    header("Location: loginform.php");
    exit();
}

$username = $_GET['username'];
$role = $_GET['role'];
$profile_picture = isset($_GET['profile_picture']) ? $_GET['profile_picture'] : 'default_profile_picture.jpg';

// Hard-coded store data for Store 1
$store = [
    'name' => 'Store 1',
    
    'location' => '123 Main Street, City, Country',
    'description' => 'This is a great store that offers a variety of products.',
    'contact' => 'contact@store1.com'
];

// Hard-coded items for Store 1
$items = [
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 2, 'name' => 'Item 2', 'price' => 20, 'image' => 'items/item2.png'],
    ['id' => 3, 'name' => 'Item 3', 'price' => 30, 'image' => 'items/item3.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png'],
    ['id' => 1, 'name' => 'Item 1', 'price' => 10, 'image' => 'items/item1.png']
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store 1 | Store Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #007bff;
            padding: 15px;
            color: white;
        }
        .navbar img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .navbar h2, .navbar p {
            margin: 0;
        }
        .item-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 30px;
        }
        .item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .cart {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cart-item input {
            width: 50px;
            text-align: center;
        }
        .payment-options {
            margin-top: 20px;
        }
        .payment-option {
            margin-bottom: 10px;
        }
        .qr-code {
            max-width: 200px;
            margin: 10px auto;
        }
    </style>
</head>
<body>
    <div class="navbar d-flex align-items-center">
       
        <div>
            <h2><?php echo htmlspecialchars($store['name']); ?></h2>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($store['location']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($store['contact']); ?></p>
        </div>
        <div class="ms-auto">
            <a href="http://localhost/intership/user_panel.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&profile_picture=<?php echo urlencode($profile_picture); ?>" class="btn btn-light">Back to User Panel</a>
        </div>
    </div>

    <div class="item-list">
        <?php foreach ($items as $item): ?>
            <div class="item">
                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                <button class="btn btn-success add-to-cart" data-id="<?php echo htmlspecialchars($item['id']); ?>" data-name="<?php echo htmlspecialchars($item['name']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">Add to Cart</button>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cart">
        <h3>Shopping Cart</h3>
        <div id="cart-items"></div>
        <h4>Total: $<span id="total">0</span></h4>
        <div class="payment-options">
            <h4>Payment Options</h4>
            <div class="payment-option">
                <input type="radio" id="cod" name="payment" value="cod" checked>
                <label for="cod">Cash on Delivery</label>
            </div>
            <div class="payment-option">
                <input type="radio" id="online" name="payment" value="online">
                <label for="online">Online Payment</label>
                <div id="online-options" style="display: none;">
                    <h5>Scan QR Code</h5>
                    <img src="images/qr_code.jpg" alt="QR Code" class="qr-code">
                    <h5>Or use UPI ID</h5>
                    <input type="text" id="upi-id" placeholder="Enter UPI ID">
                </div>
            </div>
            <button class="btn btn-primary" id="pay-button">Pay</button>
        </div>
        <div id="payment-message" style="display: none; margin-top: 20px;"></div>
    </div>
    <script>
        let cart = [];

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));

                const item = cart.find(item => item.id == id);
                if (item) {
                    item.quantity++;
                } else {
                    cart.push({ id, name, price, quantity: 1 });
                }

                updateCart();
            });
        });

        // Update cart UI
        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <span>${item.name} - $${item.price} x </span>
                    <input type="number" value="${item.quantity}" min="1" data-id="${item.id}">
                    <span> = $${itemTotal.toFixed(2)}</span>
                `;
                cartItems.appendChild(cartItem);
            });

            document.getElementById('total').textContent = total.toFixed(2);

            // Update quantity in cart
            document.querySelectorAll('.cart-item input').forEach(input => {
                input.addEventListener('change', () => {
                    const id = input.getAttribute('data-id');
                    const quantity = parseInt(input.value);
                    const item = cart.find(item => item.id == id);
                    if (item) {
                        item.quantity = quantity;
                    }

                    updateCart();
                });
            });
        }

        // Payment method change event
        document.querySelectorAll('input[name="payment"]').forEach(input => {
            input.addEventListener('change', () => {
                if (input.value === 'online') {
                    document.getElementById('online-options').style.display = 'block';
                } else {
                    document.getElementById('online-options').style.display = 'none';
                }
            });
        });

        // Pay button functionality
        document.getElementById('pay-button').addEventListener('click', () => {
            const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            let message = '';

            if (paymentMethod === 'cod') {
                message = 'Payment has been done via Cash on Delivery';
            } else if (paymentMethod === 'online') {
                const upiId = document.getElementById('upi-id').value;
                message = upiId ? `Payment has been done via UPI ID: ${upiId}` : 'Payment has been done via QR Code';
            }

            document.getElementById('payment-message').textContent = message;
            document.getElementById('payment-message').style.display = 'block';
        });
    </script>
</body>
</html>