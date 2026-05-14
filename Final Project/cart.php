<?php include 'cart_system.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MAISON | Your Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #121212;
            --bg-dark: #121212;
            --panel: #1a1a1a;
            --panel-light: #202020;
            --accent: #ffffff;
            --accent-soft: rgba(255, 255, 255, 0.10);
            --text-main: #ffffff;
            --text-alt: #666666;
            --border: #2a2a2a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body {
            background: #121212;
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 5%;
            overflow-x: hidden;
        }

        .cart-header { 
            display: flex; justify-content: space-between; align-items: flex-end;
            border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 40px;
            animation: fadeSlideDown 0.7s ease both;
        }
        .cart-header h1 { font-size: 32px; font-weight: 900; letter-spacing: -1px; }
        .cart-header span { font-size: 12px; font-weight: 700; color: var(--accent); text-transform: uppercase; }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.38);
            animation: fadeSlideUp 0.7s ease 0.15s both;
        }
        .cart-table th { text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-alt); padding-bottom: 20px; }
        
        .cart-item { border-bottom: 1px solid var(--border); transition: background 0.25s ease, transform 0.25s ease; }
        .cart-item:hover { background: rgba(255, 255, 255, 0.04); transform: translateX(4px); }
        .cart-table th, .cart-table td { padding: 18px 20px; }
        .item-info { display: flex; align-items: center; padding: 8px 0; }
        .item-image { width: 80px; height: 100px; background: var(--panel-light); border-radius: 10px; margin-right: 20px; object-fit: cover; border: 1px solid var(--border); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .cart-item:hover .item-image { transform: scale(1.04); box-shadow: 0 14px 30px rgba(0, 0, 0, 0.32); }
        .item-details h3 { font-size: 15px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .item-details p { font-size: 12px; color: var(--text-alt); }

        .price, .quantity, .total { font-size: 14px; font-weight: 400; }
        .remove-btn { color: #666666; text-decoration: none; font-size: 11px; font-weight: 700; text-transform: uppercase; transition: color 0.25s ease; }
        .remove-btn:hover { color: #ffffff; }

        .cart-summary { margin-top: 50px; display: flex; justify-content: flex-end; animation: fadeSlideUp 0.7s ease 0.25s both; }
        .summary-box { width: 300px; background: var(--panel); border: 1px solid var(--border); border-radius: 20px; padding: 24px; box-shadow: 0 24px 70px rgba(0, 0, 0, 0.34); }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; }
        .total-row { border-top: 1px solid var(--border); padding-top: 15px; font-weight: 900; font-size: 18px; }

        .checkout-btn { 
            display: block; text-align: center; text-decoration: none;
            width: 100%; padding: 20px; background: #ffffff; color: #000000; 
            border: none; border-radius: 12px; font-weight: 700; font-size: 12px; 
            letter-spacing: 2px; cursor: pointer; margin-top: 20px; transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
        }
        .checkout-btn:hover { color: #000000; filter: brightness(0.92); transform: translateY(-3px) scale(1.01); box-shadow: 0 20px 44px rgba(0, 0, 0, 0.42); }
        
        .empty-cart { text-align: center; padding: 100px 0; animation: fadeSlideUp 0.7s ease 0.15s both; }
        .empty-cart p { color: var(--text-alt); margin-bottom: 20px; }
        .shop-link { color: var(--accent); font-weight: 700; text-decoration: none; border-bottom: 2px solid var(--accent); transition: color 0.25s ease, border-color 0.25s ease; }
        .shop-link:hover { color: #ffffff; border-color: #ffffff; }

        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 760px) {
            body { padding: 28px 18px; }
            .cart-header { align-items: flex-start; flex-direction: column; gap: 8px; }
            .cart-table { display: block; overflow-x: auto; }
            .cart-summary { justify-content: stretch; }
            .summary-box { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="cart-header">
        <h1>SHOPPING BAG</h1>
        <span><?php echo count($_SESSION['cart']); ?> Items</span>
    </div>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
            <p>Your bag is currently empty.</p>
            <a href="index.php" class="shop-link">Continue Shopping</a>
        </div>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr class="cart-item">
                    <td>
                        <div class="item-info">
                            <img src="<?php echo $item['image']; ?>" class="item-image">
                            <div class="item-details">
                                <h3><?php echo $item['name']; ?></h3>
                                <p>Ref. #<?php echo $item['id']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="price">$<?php echo number_format($item['price'], 2); ?></td>
                    <td class="quantity"><?php echo $item['quantity']; ?></td>
                    <td class="total">$<?php echo number_format($subtotal, 2); ?></td>
                    <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="remove-btn">Remove</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <div class="summary-box">
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="summary-row total-row">
                    <span>Total</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
