<?php 
// Connect using your existing admin database file
include 'admin/includes/connect.php'; 
include 'includes/product_images.php';
include 'includes/header.php'; 

$latestStmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 6");
$latestProducts = $latestStmt->fetchAll();

$categoryStmt = $pdo->query("
    SELECT c.id, c.name, COUNT(p.id) AS product_count, MAX(NULLIF(p.image_url, '')) AS image_url
    FROM categories c
    LEFT JOIN products p ON p.category_id = c.id
    GROUP BY c.id, c.name
    ORDER BY c.id ASC
");
$homeCategories = $categoryStmt->fetchAll();
?>
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

<header class="hero">
    <div class="hero-content">
        <span class="label">NEW SEASON</span>
        <h1>SUMMER COLLECTION 2026</h1>
        <p>Effortless style for every moment. Discover pieces that move with you.</p>
        <a href="shop.php" class="btn-primary">SHOP NOW</a>
    </div>
    <div class="hero-showcase" aria-label="Collection highlights">
        <a href="shop.php?category=1" class="hero-showcase-panel hero-showcase-large">
            <img src="assets/images/IMG_5634.jpg" alt="White tailored summer outfit with accessories">
            <span>01</span>
            <strong>White tailoring</strong>
        </a>
        <a href="shop.php" class="hero-showcase-panel hero-showcase-texture">
            <img src="assets/images/IMG_5635.jpg" alt="Close detail of soft woven fabric">
            <span>02</span>
            <strong>Soft textures</strong>
        </a>
        <a href="shop.php?category=3" class="hero-showcase-panel hero-showcase-detail">
            <img src="assets/images/IMG_5634%20(1).jpg" alt="Accessories styled with a white outfit">
            <span>03</span>
            <strong>Finishing pieces</strong>
        </a>
    </div>
</header>



<section class="category-showcase">
    <div class="section-title">
        <h2>SHOP BY MOOD</h2>
        <p>FIND YOUR NEXT FAVORITE STARTING POINT</p>
    </div>

    <div class="category-grid">
        <?php foreach ($homeCategories as $category): ?>
            <a href="shop.php?category=<?php echo htmlspecialchars($category['id']); ?>" class="category-card">
                <div class="category-media">
                    <?php if (!empty($category['image_url'])): ?>
                        <img src="<?php echo htmlspecialchars(product_image_src($category['image_url'])); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
                    <?php else: ?>
                        <span><?php echo htmlspecialchars(substr($category['name'], 0, 1)); ?></span>
                    <?php endif; ?>
                </div>
                <div class="category-copy">
                    <span><?php echo (int) $category['product_count']; ?> products</span>
                    <h3><?php echo htmlspecialchars(strtoupper($category['name'])); ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="new-arrivals">
    <div class="section-title">
        <h2>NEW ARRIVALS EVERY WEEK</h2>
        <p>EASY RETURNS WITHIN 30 DAYS</p>
    </div>

    <div class="product-grid">
        <?php
        if(count($latestProducts) > 0) {
            foreach ($latestProducts as $product):
            ?>
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars(product_image_src($product['image_url'])); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <span class="product-placeholder"><?php echo htmlspecialchars(substr($product['name'], 0, 1)); ?></span>
                            <?php endif; ?>
                        </a>
                        
                    </div>
                    <div class="product-info">
                        <h3>
                            <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-title-link">
                                <?php echo htmlspecialchars(strtoupper($product['name'])); ?>
                            </a>
                        </h3>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        
                        <button 
                            class="add-to-cart-btn add-btn" 
                            data-id="<?php echo htmlspecialchars($product['id']); ?>" 
                            data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                            data-price="<?php echo htmlspecialchars($product['price']); ?>" 
                            data-image="<?php echo htmlspecialchars(product_image_src($product['image_url'])); ?>"
                            style="cursor: pointer; border: none; background: none; width: 100%; text-align: left;">
                            + ADD TO CART
                        </button>
                    </div>
                </div>
            <?php 
            endforeach; 
        } else {
            echo "<p style='grid-column: 1/-1; text-align: center;'>No products found. Add some in your admin panel!</p>";
        }
        ?>
    </div>
</section>

<section class="style-edit">
    <div class="style-edit-media">
        <div class="style-edit-frame">
            <span>MAISON</span>
            <strong>THE SUMMER EDIT</strong>
        </div>
    </div>
    <div class="style-edit-copy">
        <span class="section-kicker">STYLE NOTES</span>
        <h2>Light layers, sharp basics, and pieces that can carry the whole day.</h2>
        <p>Start with relaxed shirts and tailored essentials, then add accessories for contrast. The result is simple, wearable, and ready for plans that change fast.</p>
        <a href="shop.php" class="text-link">EXPLORE THE EDIT</a>
    </div>
</section>

<section class="service-strip" aria-label="Shopping benefits">
    <div>
        <i class="fa-solid fa-truck-fast"></i>
        <h3>FAST DELIVERY</h3>
        <p>Free shipping on orders over $100.</p>
    </div>
    <div>
        <i class="fa-solid fa-rotate-left"></i>
        <h3>EASY RETURNS</h3>
        <p>Try it at home with 30 day returns.</p>
    </div>
    <div>
        <i class="fa-solid fa-lock"></i>
        <h3>SECURE CHECKOUT</h3>
        <p>Your payment details stay protected.</p>
    </div>
</section>

<script src="assets/js/cart.js"></script>

<?php include 'includes/footer.php'; ?>
