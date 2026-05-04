<nav style="background: #fff; padding: 20px 50px; border-bottom: 1px solid #eee;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
        <!-- Brand Name -->
        <a href="index.php" style="font-family: 'Playfair Display', serif; font-size: 24px; letter-spacing: 5px; color: #000; text-decoration: none;">MAISON</a>
        
        <!-- Navigation Menu -->
        <div style="display: flex; gap: 30px;">
            <a href="index.php" style="text-decoration: none; color: #555; font-size: 12px; letter-spacing: 1.5px; font-weight: 400;">HOME</a>
            <a href="shop.php" style="text-decoration: none; color: #555; font-size: 12px; letter-spacing: 1.5px; font-weight: 400;">SHOP</a>
            <a href="category.php?type=women" style="text-decoration: none; color: #555; font-size: 12px; letter-spacing: 1.5px; font-weight: 400;">WOMEN</a>
            <a href="category.php?type=men" style="text-decoration: none; color: #555; font-size: 12px; letter-spacing: 1.5px; font-weight: 400;">MEN</a>
            <a href="category.php?type=accessories" style="text-decoration: none; color: #555; font-size: 12px; letter-spacing: 1.5px; font-weight: 400;">ACCESSORIES</a>
        </div>

        <!-- Utility Icons -->
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="#" style="text-decoration: none; color: #333;">🔍</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="login.php" style="text-decoration: none; color: #333;">👤</a>
                <a href="logout.php" style="font-size: 11px; color: #888; text-decoration: none; letter-spacing: 1px;">LOGOUT</a>
            <?php else: ?>
                <a href="login.php" style="text-decoration: none; color: #333;">👤</a>
            <?php endif; ?>
            <a href="cart.php" style="text-decoration: none; color: #333;">🛍️</a>
        </div>
    </div>
</nav>