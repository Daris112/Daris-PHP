<?php
// 1. Connection & Session
require_once __DIR__ . '/admin/includes/connect.php'; 
session_start();

// 2. Data Retrieval
try {
    $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              ORDER BY p.id DESC";
    $stmt = $pdo->prepare($query); 
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    // Silently handle or log error
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dita Store | Premium Streetwear</title>
    <!-- Keep your original fonts and add Tailwind for the layout -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;900&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .premium-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#fdfcfb]">

    <!-- Top Announcement Bar -->
    <div class="bg-black text-white text-[10px] font-bold text-center py-3 tracking-[0.3em] uppercase">
        Shipping on orders over $100 | New arrivals every week | Easy returns
    </div>

    <?php 
    // 3. Include the Navbar
    include __DIR__ . '/includes/navbar.php'; 

    // 4. Include the Hero (Home Page Only)
    include __DIR__ . '/includes/hero.php'; 
    ?>

    <!-- Main Content: Shop by Category / Products -->
    <main class="max-w-7xl mx-auto px-8 py-20">
        
        <div class="text-center mb-16">
            <p class="text-[#c9ab81] tracking-[4px] text-[10px] uppercase font-bold mb-4">Curated Selection</p>
            <h2 class="premium-title text-4xl md:text-5xl font-normal text-slate-900">Latest Arrivals</h2>
            <div class="h-px w-20 bg-[#c9ab81] mx-auto mt-6"></div>
        </div>

        <!-- Dynamic Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
            <?php foreach($products as $product): ?>
            <div class="group">
                <div class="relative aspect-[3/4] overflow-hidden bg-white rounded-2xl shadow-sm transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2">
                    
                    <?php if(!empty($product['image_url'])): ?>
                        <img src="assets/images/<?php echo htmlspecialchars($product['image_url']); ?>" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <i class="fas fa-tshirt text-4xl text-slate-300"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Overlay Badge -->
                    <span class="absolute top-6 left-6 bg-white/90 backdrop-blur text-black text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-sm">
                        Premium
                    </span>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-[9px] text-[#c9ab81] font-bold uppercase tracking-widest mb-2">
                        <?php echo htmlspecialchars($product['category_name'] ?? 'Essentials'); ?>
                    </p>
                    <h3 class="text-lg font-medium text-slate-800 mb-1">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h3>
                    <p class="text-xl font-bold text-slate-900 tracking-tighter">
                        $<?php echo number_format($product['price'], 2); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php 
    // 5. Include the Footer
    include __DIR__ . '/includes/footer.php'; 
    ?>

</body>
</html>