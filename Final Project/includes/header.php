<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$accountName = trim($_SESSION['username'] ?? $_SESSION['first_name'] ?? '');
if ($accountName === '') {
    $accountName = 'Customer';
}

$accountInitial = strtoupper(substr($accountName, 0, 1));
$userRole = strtolower(trim($_SESSION['role'] ?? ''));
$searchQuery = trim($_GET['q'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAISON | Modern Fashion</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="announcement-bar">
        FREE SHIPPING ON ORDERS OVER $100
    </div>
    
    <nav class="main-nav">
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="shop.php">SHOP ALL</a>
            <a href="shop.php?category=1">WOMEN</a>
            <a href="shop.php?category=2">MEN</a>
            <a href="shop.php?category=3">ACCESSORIES</a>
        </div>
        
        <div class="logo"><a href="index.php">MAISON</a></div>
        
        <div class="nav-icons">
            <form action="shop.php" method="GET" class="nav-search" role="search">
                <?php if (isset($_GET['category'])): ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($_GET['category']); ?>">
                <?php endif; ?>
                <?php
                    $activePriceFilters = $_GET['price'] ?? array();
                    if (!is_array($activePriceFilters)) {
                        $activePriceFilters = array($activePriceFilters);
                    }
                ?>
                <?php foreach ($activePriceFilters as $activePriceFilter): ?>
                    <input type="hidden" name="price[]" value="<?php echo htmlspecialchars($activePriceFilter); ?>">
                <?php endforeach; ?>
                <input
                    type="search"
                    name="q"
                    class="nav-search-input"
                    placeholder="Search products..."
                    value="<?php echo htmlspecialchars($searchQuery); ?>"
                    aria-label="Search products"
                >
                <button type="button" class="icon search-toggle" aria-label="Open search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button type="submit" class="search-submit" aria-label="Search products">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <div class="search-results" aria-live="polite"></div>
            </form>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="user-menu">
                    <div class="user-menu-text">
                        <span class="user-welcome"><?php echo htmlspecialchars($accountName); ?></span>
                        <a href="logout.php" class="logout-link">Logout</a>
                    </div>
                    <div class="user-avatar">
                        <?php echo htmlspecialchars($accountInitial); ?>
                    </div>
                </div>
                
                <?php if($userRole === 'admin'): ?>
                    <a href="admin/index.php" class="admin-link">PANEL</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" class="icon"><i class="fa-regular fa-user"></i></a>
            <?php endif; ?>

            <a href="cart.php" class="icon cart-icon-wrapper">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">
                    <?php 
                        $count = 0;
                        if(isset($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $item) {
                                $count += $item['quantity'];
                            }
                        }
                        echo $count;
                    ?>
                </span>
            </a>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('.nav-search');
            if (!searchForm) return;

            const toggle = searchForm.querySelector('.search-toggle');
            const input = searchForm.querySelector('.nav-search-input');
            const results = searchForm.querySelector('.search-results');
            let searchTimer;

            if (input.value.trim() !== '') {
                searchForm.classList.add('is-open');
            }

            function closeResults() {
                results.classList.remove('is-visible');
                results.innerHTML = '';
            }

            function escapeHtml(value) {
                return String(value ?? '').replace(/[&<>"']/g, function(character) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    }[character];
                });
            }

            function renderResults(products, query) {
                if (products.length === 0) {
                    results.innerHTML = '<div class="search-empty">No products found for "' + escapeHtml(query) + '"</div>';
                    results.classList.add('is-visible');
                    return;
                }

                results.innerHTML = products.map(function(product) {
                    const name = escapeHtml(product.name);
                    const category = escapeHtml(product.category_name || 'Product');
                    const image = product.image_src || '';
                    const imageMarkup = image
                        ? '<img src="' + escapeHtml(image) + '" alt="">'
                        : '<span class="search-result-placeholder">' + name.charAt(0).toUpperCase() + '</span>';

                    return '' +
                        '<a class="search-result-item" href="product.php?id=' + encodeURIComponent(product.id) + '">' +
                            '<span class="search-result-image">' + imageMarkup + '</span>' +
                            '<span class="search-result-copy">' +
                                '<strong>' + name + '</strong>' +
                                '<small>' + category + ' / $' + Number(product.price).toFixed(2) + '</small>' +
                            '</span>' +
                        '</a>';
                }).join('');

                results.classList.add('is-visible');
            }

            function fetchResults() {
                const query = input.value.trim();

                clearTimeout(searchTimer);

                if (query.length < 2) {
                    closeResults();
                    return;
                }

                searchTimer = setTimeout(function() {
                    fetch('search_products.php?q=' + encodeURIComponent(query))
                        .then(function(response) {
                            if (!response.ok) throw new Error('Search failed');
                            return response.json();
                        })
                        .then(function(products) {
                            renderResults(products, query);
                        })
                        .catch(function() {
                            closeResults();
                        });
                }, 180);
            }

            toggle.addEventListener('click', function() {
                if (!searchForm.classList.contains('is-open')) {
                    searchForm.classList.add('is-open');
                    input.focus();
                    fetchResults();
                    return;
                }

                if (input.value.trim() !== '') {
                    searchForm.submit();
                    return;
                }

                input.focus();
            });

            input.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    input.value = '';
                    searchForm.classList.remove('is-open');
                    closeResults();
                    toggle.focus();
                }
            });

            input.addEventListener('input', fetchResults);

            input.addEventListener('focus', function() {
                if (input.value.trim().length >= 2) {
                    fetchResults();
                }
            });

            document.addEventListener('click', function(event) {
                if (!searchForm.contains(event.target)) {
                    closeResults();
                }
            });
        });
    </script>
