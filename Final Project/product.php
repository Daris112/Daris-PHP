<?php 
session_start();
require_once 'admin/includes/connect.php'; 
include 'includes/header.php'; 

$product_id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: shop.php");
    exit();
}
?>

<main class="product-view-container">
    <div class="breadcrumb">
        <a href="index.php">Home</a> / <a href="shop.php">Shop</a> / <?php echo htmlspecialchars(strtoupper($product['name'])); ?>
    </div>

    <div class="product-layout">
        <div class="product-gallery">
            <div class="main-image-wrapper">
                <img src="assets/img/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
        </div>

        <aside class="product-details-side">
            <span class="category-label">NEW SEASON</span>
            <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>

            <div class="product-description">
                <?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?>
            </div>

            <div class="selection-group">
                <div class="selection-header">
                    <label>SELECT SIZE</label>
                    <a href="#" class="size-guide">Size Guide</a>
                </div>
                <div class="size-options">
                    <?php 
                    $sizes = explode(',', $product['sizes']);
                    foreach($sizes as $index => $size): ?>
                        <button type="button" class="size-btn <?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars(trim($size)); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="add-to-cart-large add-to-cart-btn" 
                    data-id="<?php echo htmlspecialchars($product['id']); ?>" 
                    data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                    data-price="<?php echo htmlspecialchars($product['price']); ?>" 
                    data-image="assets/img/<?php echo htmlspecialchars($product['image_url']); ?>"
                    type="button">
                ADD TO BAG
            </button>

            <div class="extra-info">
                <p><i class="fa-solid fa-truck"></i> FREE SHIPPING ON ORDERS OVER $100</p>
                <p><i class="fa-solid fa-rotate"></i> 30-DAY EASY RETURNS</p>
            </div>
        </aside>
    </div>
</main>

<script>
// Visual selection for sizes
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>

<script src="assets/js/cart.js"></script>
<?php include 'includes/footer.php'; ?>
