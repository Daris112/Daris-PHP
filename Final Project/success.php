<?php include 'includes/header.php'; ?>

<style>
    .success-page {
        min-height: 72vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 90px 5%;
        background: #121212;
    }

    .success-card {
        width: 100%;
        max-width: 680px;
        padding: 48px;
        text-align: center;
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
        border-radius: 22px;
        box-shadow: 0 26px 70px rgba(0, 0, 0, 0.34);
    }

    .success-icon {
        width: 74px;
        height: 74px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        border-radius: 50%;
        color: #000000;
        background: #ffffff;
        font-size: 34px;
        font-weight: 900;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
    }

    .success-label {
        margin: 0 0 10px;
        color: #ffffff;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .success-card h1 {
        margin: 0 0 18px;
        color: #ffffff;
        font-size: 46px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    .success-card p {
        max-width: 500px;
        margin: 0 auto 10px;
        color: #ffffff;
        font-size: 16px;
        line-height: 1.7;
    }

    .success-card .muted {
        color: #666666;
    }

    .order-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 22px 0 28px;
        padding: 11px 16px;
        border: 1px solid #2a2a2a;
        border-radius: 999px;
        color: #ffffff;
        background: #202020;
        font-size: 13px;
        font-weight: 800;
    }

    .success-actions {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .success-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        padding: 0 24px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 1.8px;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .success-btn.primary {
        color: #000000;
        background: #ffffff;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
    }

    .success-btn.secondary {
        color: #ffffff;
        border: 1px solid #2a2a2a;
        background: #202020;
    }

    .success-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 42px rgba(0, 0, 0, 0.28);
    }

    .success-btn.secondary:hover {
        border-color: #ffffff;
        color: #ffffff;
    }

    @media (max-width: 560px) {
        .success-page {
            padding: 60px 18px;
        }

        .success-card {
            padding: 34px 22px;
        }

        .success-card h1 {
            font-size: 34px;
        }

        .success-actions {
            flex-direction: column;
        }
    }
</style>

<main class="success-page">
    <section class="success-card">
        <div class="success-icon">&#10003;</div>
        <p class="success-label">Order confirmed</p>
        <h1>THANK YOU</h1>
        <p>Your order has been placed successfully.</p>
        <div class="order-pill">Order #<?php echo htmlspecialchars($_GET['order'] ?? ''); ?></div>
        <p class="muted">A confirmation email has been sent to your inbox.</p>

        <div class="success-actions">
            <a href="shop.php" class="success-btn primary">CONTINUE SHOPPING</a>
            <a href="index.php" class="success-btn secondary">GO HOME</a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
