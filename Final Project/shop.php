<?php 
session_start();
require_once 'admin/includes/connect.php'; 
include 'includes/header.php'; 

// Fetch categories for the filter bar
$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll();

// Check if a category is selected via URL
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;

if ($categoryFilter) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY id DESC");
    $stmt->execute([$categoryFilter]);
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}
?>

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

<main class="shop-container">
    <header class="shop-header">
        <h1>THE COLLECTION</h1>
        <p>Curated pieces designed for longevity and style.</p>
    </header>

    <nav class="shop-filters">
        <a href="shop.php" class="<?php echo !$categoryFilter ? 'active' : ''; ?>">ALL</a>
        <?php foreach ($categories as $cat): ?>
            <a href="shop.php?category=<?php echo $cat['id']; ?>" 
               class="<?php echo $categoryFilter == $cat['id'] ? 'active' : ''; ?>">
               <?php echo strtoupper($cat['name']); ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="product-grid">
        <?php if($stmt->rowCount() > 0): ?>
            <?php while ($product = $stmt->fetch()): ?>
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="assets/img/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                        <button class="wishlist-btn">&hearts;</button>
                    </div>
                    <div class="product-info">
                        <h3><?php echo strtoupper($product['name']); ?></h3>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        
                        <button 
                            class="add-to-cart-btn add-btn" 
                            data-id="<?php echo $product['id']; ?>" 
                            data-name="<?php echo $product['name']; ?>" 
                            data-price="<?php echo $product['price']; ?>" 
                            data-image="assets/img/<?php echo $product['image_url']; ?>"
                            type="button">
                            + ADD TO CART
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-results">No products found in this category.</p>
        <?php endif; ?>
    </div>
</main>

<script src="assets/js/cart.js"></script>

<?php include 'includes/footer.php'; ?>