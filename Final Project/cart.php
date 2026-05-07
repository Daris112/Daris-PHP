<?php include 'cart_system.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MAISON | Your Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <style>
        :root { --black: #000; --gray: #f9f9f9; --border: #eee; --text-alt: #888; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #fff; color: var(--black); padding: 40px 5%; }

        .cart-header { 
            display: flex; justify-content: space-between; align-items: flex-end;
            border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 40px;
        }
        .cart-header h1 { font-size: 32px; font-weight: 900; letter-spacing: -1px; }
        .cart-header span { font-size: 12px; font-weight: 700; color: var(--text-alt); text-transform: uppercase; }

        .cart-table { width: 100%; border-collapse: collapse; }
        .cart-table th { text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-alt); padding-bottom: 20px; }
        
        .cart-item { border-bottom: 1px solid var(--border); }
        .item-info { display: flex; align-items: center; padding: 25px 0; }
        .item-image { width: 80px; height: 100px; background: var(--gray); border-radius: 8px; margin-right: 20px; object-fit: cover; }
        .item-details h3 { font-size: 15px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .item-details p { font-size: 12px; color: var(--text-alt); }

        .price, .quantity, .total { font-size: 14px; font-weight: 400; }
        .remove-btn { color: #ff4d4d; text-decoration: none; font-size: 11px; font-weight: 700; text-transform: uppercase; }

        .cart-summary { margin-top: 50px; display: flex; justify-content: flex-end; }
        .summary-box { width: 300px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; }
        .total-row { border-top: 1px solid var(--black); padding-top: 15px; font-weight: 900; font-size: 18px; }

        .checkout-btn { 
            width: 100%; padding: 20px; background: var(--black); color: #fff; 
            border: none; border-radius: 12px; font-weight: 700; font-size: 12px; 
            letter-spacing: 2px; cursor: pointer; margin-top: 20px; transition: 0.3s;
        }
        .checkout-btn:hover { opacity: 0.8; transform: translateY(-2px); }
        
        .empty-cart { text-align: center; padding: 100px 0; }
        .empty-cart p { color: var(--text-alt); margin-bottom: 20px; }
        .shop-link { color: var(--black); font-weight: 700; text-decoration: none; border-bottom: 2px solid var(--black); }
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
                <button class="checkout-btn">PROCEED TO CHECKOUT</button>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>