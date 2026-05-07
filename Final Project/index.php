<?php 
// Connect using your existing admin database file
include 'admin/includes/connect.php'; 
include 'includes/header.php'; 
?>
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<header class="hero">
    <div class="hero-content">
        <span class="label">NEW SEASON</span>
        <h1>SUMMER COLLECTION 2025</h1>
        <p>Effortless style for every moment. Discover pieces that move with you.</p>
        <a href="shop.php" class="btn-primary">SHOP NOW</a>
    </div>
</header>

<section class="new-arrivals">
    <div class="section-title">
        <h2>NEW ARRIVALS EVERY WEEK</h2>
        <p>EASY RETURNS WITHIN 30 DAYS</p>
    </div>

    <div class="product-grid">
        <?php
        // Fetch the 4 most recently added products from your database
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
        
        if($stmt->rowCount() > 0) {
            while ($product = $stmt->fetch()):
            ?>
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="assets/img/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                        <button class="wishlist-btn">&hearts;</button>
                    </div>
                    <div class="product-info">
                        <h3><?php echo strtoupper($product['name']); ?></h3>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="add-btn">+ ADD TO CART</a>
                    </div>
                </div>
            <?php 
            endwhile; 
        } else {
            echo "<p style='grid-column: 1/-1; text-align: center;'>No products found. Add some in your admin panel!</p>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>