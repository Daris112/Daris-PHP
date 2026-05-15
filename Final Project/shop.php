<?php 
session_start();
// Database connection
require_once 'admin/includes/connect.php'; 
include 'includes/header.php'; 

// 1. Logic: Get current category for the header and filtering
$current_cat_id = isset($_GET['category']) ? $_GET['category'] : null;
$search_query = trim($_GET['q'] ?? '');
$selected_price_filters = $_GET['price'] ?? array();

if (!is_array($selected_price_filters)) {
    $selected_price_filters = array($selected_price_filters);
}

$price_ranges = array(
    'under_50' => array('label' => 'Under $50', 'sql' => 'p.price < 50'),
    '50_100' => array('label' => '$50 - $100', 'sql' => 'p.price >= 50 AND p.price <= 100'),
    '100_200' => array('label' => '$100 - $200', 'sql' => 'p.price >= 100 AND p.price <= 200'),
    '200_plus' => array('label' => '$200+', 'sql' => 'p.price >= 200')
);

$selected_price_filters = array_values(array_intersect($selected_price_filters, array_keys($price_ranges)));

function buildShopUrl($categoryId, $searchQuery, $priceFilters) {
    $query = array();

    if ($categoryId) {
        $query['category'] = $categoryId;
    }

    if ($searchQuery !== '') {
        $query['q'] = $searchQuery;
    }

    foreach ($priceFilters as $priceFilter) {
        $query['price'][] = $priceFilter;
    }

    $queryString = http_build_query($query);
    return 'shop.php' . ($queryString !== '' ? '?' . $queryString : '');
}

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

// 2. Logic: Fetch Products based on filters and search
$where = array();
$params = array();

if ($current_cat_id) {
    $where[] = "p.category_id = ?";
    $params[] = $current_cat_id;
}

if ($search_query !== '') {
    $where[] = "(p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?)";
    $search_like = "%" . $search_query . "%";
    $params[] = $search_like;
    $params[] = $search_like;
    $params[] = $search_like;
}

if (!empty($selected_price_filters)) {
    $price_where = array();

    foreach ($selected_price_filters as $price_filter) {
        $price_where[] = '(' . $price_ranges[$price_filter]['sql'] . ')';
    }

    $where[] = '(' . implode(' OR ', $price_where) . ')';
}

$sql = "SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<div class="shop-wrapper">
    <aside class="shop-sidebar">
        <div class="breadcrumb">Home / <?php echo $current_cat_name; ?></div>
        <h1 class="shop-title"><?php echo $search_query !== '' ? 'Search Results' : $current_cat_name; ?></h1>
        <?php if ($search_query !== ''): ?>
            <p class="count-text">For "<?php echo htmlspecialchars($search_query); ?>"</p>
        <?php endif; ?>
        <p class="count-text"><?php echo count($products); ?> products</p>

        <div class="filter-group">
            <h3>CATEGORY</h3>
            <div class="filter-list">
                <label class="filter-option">
                    <input type="checkbox" <?php echo !$current_cat_id ? 'checked' : ''; ?> 
                           onclick="window.location.href='<?php echo htmlspecialchars(buildShopUrl(null, $search_query, $selected_price_filters)); ?>'">
                    <span class="custom-check"></span> All
                </label>
                <?php foreach ($categories as $cat): ?>
                    <label class="filter-option">
                        <input type="checkbox" <?php echo ($current_cat_id == $cat['id']) ? 'checked' : ''; ?> 
                               onclick="window.location.href='<?php echo htmlspecialchars(buildShopUrl($cat['id'], $search_query, $selected_price_filters)); ?>'">
                        <span class="custom-check"></span> <?php echo $cat['name']; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="filter-group">
            <h3>PRICE</h3>
            <div class="filter-list">
                <?php foreach ($price_ranges as $price_key => $price_range): ?>
                    <?php
                        $updated_price_filters = $selected_price_filters;

                        if (in_array($price_key, $updated_price_filters)) {
                            $updated_price_filters = array_values(array_diff($updated_price_filters, array($price_key)));
                        } else {
                            $updated_price_filters[] = $price_key;
                        }
                    ?>
                    <label class="filter-option">
                        <input type="checkbox"
                               <?php echo in_array($price_key, $selected_price_filters) ? 'checked' : ''; ?>
                               onclick="window.location.href='<?php echo htmlspecialchars(buildShopUrl($current_cat_id, $search_query, $updated_price_filters)); ?>'">
                        <span class="custom-check"></span> <?php echo htmlspecialchars($price_range['label']); ?>
                    </label>
                <?php endforeach; ?>
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
            <?php if(count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
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
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-msg">No products found<?php echo $search_query !== '' ? ' for "' . htmlspecialchars($search_query) . '"' : ' in this category'; ?>.</div>
            <?php endif; ?>
        </div>
    </main>
</div>

<script src="assets/js/cart.js"></script>
<?php include 'includes/footer.php'; ?>
