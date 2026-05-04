<?php
// 1. Database Connection & Session
require_once('admin/includes/connect.php'); 
session_start();

// 2. Fetch all products with Category names
try {
    $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              ORDER BY p.id DESC";
    $stmt = $pdo->prepare($query); 
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}

// 3. Include the Header (contains Nav and CSS)
include('includes/header.php'); 
?>

<!-- Announcement Bar -->
<div class="bg-black text-white text-[10px] font-black uppercase tracking-[0.3em] py-3 text-center">
    Free Shipping on orders over $100 | New Drops Every Friday
</div>

<!-- Hero Header Section -->
<header class="max-w-7xl mx-auto px-8 py-20 md:py-32 text-center">
    <div class="inline-block px-4 py-1.5 rounded-full bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest mb-8">
        Summer Drop 2026
    </div>
    <h1 class="text-6xl md:text-8xl font-black tracking-tighter italic uppercase text-slate-900 leading-none mb-8">
        Quality over <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-400">Everything.</span>
    </h1>
    <p class="text-slate-500 font-medium text-lg max-w-xl mx-auto leading-relaxed">
        Curated minimal streetwear and premium essentials designed for the modern individual.
    </p>
    <div class="mt-12">
        <a href="#catalog" class="bg-black text-white px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-2xl shadow-slate-200">
            Shop Collection
        </a>
    </div>
</header>

<!-- Product Catalog -->
<main id="catalog" class="max-w-7xl mx-auto px-8 pb-32">
    <div class="flex justify-between items-end mb-16">
        <div>
            <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tighter italic">Latest Arrivals</h2>
            <div class="h-1.5 w-12 bg-black mt-3 rounded-full"></div>
        </div>
        <p class="text-slate-400 font-bold text-[10px] uppercase tracking-widest">
            <?php echo count($products); ?> Exclusive Pieces
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        <?php foreach($products as $product): ?>
        <div class="group">
            <div class="relative aspect-[3/4] bg-white rounded-[3rem] border border-slate-100 overflow-hidden shadow-sm transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-slate-200 group-hover:-translate-y-3">
                
                <!-- Product Image Logic -->
                <?php if(!empty($product['image_url'])): ?>
                    <img src="assets/images/<?php echo htmlspecialchars($product['image_url']); ?>" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <?php else: ?>
                    <div class="w-full h-full bg-slate-50 flex items-center justify-center">
                        <i class="fas fa-tshirt text-5xl text-slate-200"></i>
                    </div>
                <?php endif; ?>

                <!-- Hover Quick View -->
                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <button class="bg-white text-black px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform">
                        Quick View
                    </button>
                </div>

                <!-- Badge -->
                <span class="absolute top-8 left-8 bg-black text-white text-[8px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest">
                    <?php echo ($product['id'] > 5) ? 'New Drop' : 'Essential'; ?>
                </span>
            </div>

            <div class="mt-8 text-center px-4">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">
                    <?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?>
                </p>
                <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-black transition-colors">
                    <?php echo htmlspecialchars($product['name']); ?>
                </h3>
                <p class="text-xl font-black text-slate-900 tracking-tighter">
                    $<?php echo number_format($product['price'], 2); ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>