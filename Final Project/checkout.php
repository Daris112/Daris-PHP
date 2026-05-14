<?php 
session_start();
require_once 'admin/includes/connect.php';
include 'includes/header.php';

if (empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit();
}

$total = 0;
foreach($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<style>
    .checkout-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 100px 5% 70px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 42px;
        color: #ffffff;
    }

    .checkout-form,
    .order-summary {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
        border-radius: 22px;
        box-shadow: 0 26px 70px rgba(0, 0, 0, 0.34);
    }

    .checkout-form {
        padding: 38px;
    }

    .checkout-title {
        margin: 0 0 28px;
        color: #ffffff;
        font-size: 32px;
        font-weight: 900;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #666666;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #2a2a2a;
        border-radius: 14px;
        outline: none;
        background: #202020;
        color: #ffffff;
        font: inherit;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #ffffff;
        background: #1a1a1a;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.10);
    }

    .place-order-btn {
        width: 100%;
        min-height: 52px;
        border: 0;
        border-radius: 14px;
        background: #ffffff;
        color: #000000;
        cursor: pointer;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 2px;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
        transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
    }

    .place-order-btn:hover {
        filter: brightness(0.92);
        transform: translateY(-2px);
        box-shadow: 0 20px 44px rgba(0, 0, 0, 0.42);
    }

    .order-summary {
        height: fit-content;
        padding: 30px;
    }

    .order-summary h3 {
        margin: 0;
        color: #ffffff;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 2px;
    }

    .summary-line {
        border: 0;
        border-top: 1px solid #2a2a2a;
        margin: 20px 0;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 15px;
        color: #ffffff;
        font-size: 14px;
    }

    .summary-total {
        color: #ffffff;
        font-weight: 900;
    }

    @media (max-width: 860px) {
        .checkout-container {
            grid-template-columns: 1fr;
            padding: 70px 18px;
        }

        .checkout-form,
        .order-summary {
            padding: 26px;
        }
    }
</style>

<div class="checkout-container">
    <div class="checkout-form">
        <h2 class="checkout-title">Shipping Details</h2>
        <form action="process_checkout.php" method="POST">
            <div class="form-group">
                <label>FULL NAME</label>
                <input type="text" name="full_name" required value="<?php echo $_SESSION['first_name'] ?? ''; ?>">
            </div>
            <div class="form-group">
                <label>EMAIL ADDRESS</label>
                <input type="email" name="email" required value="<?php echo $_SESSION['user_email'] ?? ''; ?>">
            </div>
            <div class="form-group">
                <label>SHIPPING ADDRESS</label>
                <textarea name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>CITY</label>
                <input type="text" name="city" required>
            </div>
            <button type="submit" class="place-order-btn">PLACE ORDER</button>
        </form>
    </div>

    <div class="order-summary">
        <h3>YOUR ORDER</h3>
        <hr class="summary-line">
        <?php foreach($_SESSION['cart'] as $item): ?>
            <div class="summary-item">
                <span><?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
            </div>
        <?php endforeach; ?>
        <hr class="summary-line">
        <div class="summary-item summary-total">
            <span>TOTAL</span>
            <span>$<?php echo number_format($total, 2); ?></span>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
