<?php 
session_start();
// Database connection
require_once 'admin/includes/connect.php'; 
include 'includes/header.php'; 

// 1. Logic: Get current category for the header and filtering
$current_cat_id = isset($_GET['category']) ? $_GET['category'] : null;

// Fetch categories for the sidebar
$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll();

// Determine current category name
$current_cat_name = "All Products";
if ($current_cat_id) {
    foreach ($categories as $cat) {
        if ($cat['id'] == $current_cat_id) {
            $current_cat_name = $cat['name'];
            break;
        }
    }
}

// 2. Logic: Fetch Products based on filter
if ($current_cat_id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY id DESC");
    $stmt->execute([$current_cat_id]);
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}
?>

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<div class="shop-wrapper">
    <aside class="shop-sidebar">
        <div class="breadcrumb">Home / <?php echo $current_cat_name; ?></div>
        <h1 class="shop-title"><?php echo $current_cat_name; ?></h1>
        <p class="count-text"><?php echo $stmt->rowCount(); ?> products</p>

        <div class="filter-group">
            <h3>CATEGORY</h3>
            <div class="filter-list">
                <label class="filter-option">
                    <input type="checkbox" <?php echo !$current_cat_id ? 'checked' : ''; ?> 
                           onclick="window.location.href='shop.php'">
                    <span class="custom-check"></span> All
                </label>
                <?php foreach ($categories as $cat): ?>
                    <label class="filter-option">
                        <input type="checkbox" <?php echo ($current_cat_id == $cat['id']) ? 'checked' : ''; ?> 
                               onclick="window.location.href='shop.php?category=<?php echo $cat['id']; ?>'">
                        <span class="custom-check"></span> <?php echo $cat['name']; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="filter-group">
            <h3>PRICE</h3>
            <div class="filter-list">
                <label class="filter-option"><input type="checkbox"><span class="custom-check"></span> Under $50</label>
                <label class="filter-option"><input type="checkbox"><span class="custom-check"></span> $50 – $100</label>
                <label class="filter-option"><input type="checkbox"><span class="custom-check"></span> $100 – $200</label>
                <label class="filter-option"><input type="checkbox"><span class="custom-check"></span> $200+</label>
            </div>
        </div>
    </aside>

    <main class="shop-content">
        <div class="shop-utils">
            <select class="sort-select">
                <option>NEWEST</option>
                <option>PRICE: LOW TO HIGH</option>
                <option>PRICE: HIGH TO LOW</option>
            </select>
        </div>

        <div class="shop-grid">
            <?php if($stmt->rowCount() > 0): ?>
                <?php while ($product = $stmt->fetch()): ?>
                    <div class="product-item">
                        <div class="image-container">
                            <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
                                <img src="assets/img/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </a>
                            <button class="add-to-cart-btn" 
                                    data-id="<?php echo htmlspecialchars($product['id']); ?>" 
                                    data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                                    data-price="<?php echo htmlspecialchars($product['price']); ?>" 
                                    data-image="assets/img/<?php echo htmlspecialchars($product['image_url']); ?>"
                                    type="button">
                                + ADD TO CART
                            </button>
                        </div>
                        <div class="item-meta">
                            <h4>
                                <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product-title-link">
                                    <?php echo htmlspecialchars(strtoupper($product['name'])); ?>
                                </a>
                            </h4>
                            <span class="item-price">$<?php echo number_format($product['price'], 2); ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-msg">No items found in this category.</div>
            <?php endif; ?>
        </div>
    </main>
</div>

<script src="assets/js/cart.js"></script>
<?php include 'includes/footer.php'; ?>
