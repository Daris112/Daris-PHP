<?php 
session_start();
require_once 'admin/includes/connect.php'; 

// 1. Get Product ID from URL
if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit();
}

$product_id = $_GET['id'];

// 2. Fetch Product Details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    include 'includes/header.php';
    echo "<div class='empty-msg product-missing'>Product not found.</div>";
    include 'includes/footer.php';
    exit();
}

include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

<main class="product-view-container">
    <div class="product-layout">
        
        <div class="product-gallery">
            <div class="breadcrumb">
                Home / Shop / <?php echo $product['name']; ?>
            </div>
            <div class="main-image-wrapper">
                <img src="assets/img/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
        </div>

        <div class="product-details-side">
            <span class="category-label">COLLECTION</span>
            <h1 class="product-title"><?php echo $product['name']; ?></h1>
            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
            
            <p class="product-description">
                <?php echo $product['description'] ?? 'Impeccably designed piece for effortless transitions. Crafted with premium materials for lasting quality.'; ?>
            </p>

            <div class="selection-group">
                <div class="selection-header">
                    <label>SIZE</label>
                    <a href="#" class="size-guide">Size Guide</a>
                </div>
                <div class="size-options">
                    <button class="size-btn">S</button>
                    <button class="size-btn active">M</button>
                    <button class="size-btn">L</button>
                    <button class="size-btn">XL</button>
                </div>
            </div>

            <div class="selection-group">
                <label>COLOR</label>
                <div class="color-options">
                    <span class="color-swatch black active"></span>
                    <span class="color-swatch cream"></span>
                    <span class="color-swatch olive"></span>
                </div>
            </div>

            <button class="add-to-cart-large add-to-cart-btn" 
                    data-id="<?php echo $product['id']; ?>" 
                    data-name="<?php echo $product['name']; ?>" 
                    data-price="<?php echo $product['price']; ?>" 
                    data-image="assets/img/<?php echo $product['image_url']; ?>">
                ADD TO BAG
            </button>

            <div class="extra-info">
                <p><i class="fa-solid fa-truck-fast"></i> Free shipping on orders over $100</p>
                <p><i class="fa-solid fa-rotate-left"></i> 30-day easy returns</p>
            </div>
        </div>

    </div>
</main>

<script src="assets/js/cart.js"></script>
<?php include 'includes/footer.php'; ?>
