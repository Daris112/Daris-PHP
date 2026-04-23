<?php
// 1. Connection to the database
include('includes/connect.php');

// 2. Fetch all products for the public to browse
try {
    $query = "SELECT * FROM products ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dita Store | High-End Fashion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 py-5 px-8 md:px-16 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                <i class="fas fa-bolt text-lg"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tighter uppercase">Dita <span class="text-blue-600">Store</span></h1>
        </div>

        <div class="flex items-center gap-8">
            <ul class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-slate-400">
                <li class="text-blue-600"><a href="#">Home</a></li>
                <li class="hover:text-slate-800 transition-colors"><a href="#">New Arrivals</a></li>
                <li class="hover:text-slate-800 transition-colors"><a href="#">Collections</a></li>
            </ul>

            <a href="login.php" class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 hover:-translate-y-0.5 transition-all shadow-xl shadow-slate-200">
                <span>Login</span>
                <i class="fas fa-user-circle text-sm opacity-50"></i>
            </a>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-8 py-16 md:py-24 text-center">
        <span class="text-blue-600 font-black text-[10px] uppercase tracking-[0.3em] bg-blue-50 px-4 py-2 rounded-full">Summer Collection 2026</span>
        <h2 class="text-5xl md:text-7xl font-black tracking-tight mt-6 mb-8 text-slate-900">Quality over <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">everything.</span></h2>
        <p class="text-slate-500 text-lg max-w-xl mx-auto font-medium leading-relaxed">
            Discover our curated selection of minimal streetwear and premium essentials designed in Prizren.
        </p>
    </header>

    <main class="max-w-7xl mx-auto px-8 pb-24">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Our Catalog</h3>
                <div class="h-1 w-12 bg-blue-600 mt-2 rounded-full"></div>
            </div>
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest"><?php echo count($products); ?> Items Found</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php foreach($products as $row): ?>
            <div class="group cursor-pointer">
                <div class="relative aspect-[3/4] bg-white rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center justify-center overflow-hidden transition-all group-hover:shadow-2xl group-hover:shadow-blue-500/10 group-hover:-translate-y-2">
                    <i class="fas fa-tshirt text-6xl text-slate-100 group-hover:scale-110 group-hover:text-blue-50 transition-all duration-500"></i>
                    
                    <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/5 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-white text-slate-900 px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl">View Details</button>
                    </div>

                    <?php if($row['stock'] < 10 && $row['stock'] > 0): ?>
                        <span class="absolute top-6 left-6 bg-orange-500 text-white text-[8px] font-black px-3 py-1.5 rounded-full uppercase tracking-tighter shadow-lg shadow-orange-200">Limited Stock</span>
                    <?php elseif($row['stock'] <= 0): ?>
                        <span class="absolute top-6 left-6 bg-slate-800 text-white text-[8px] font-black px-3 py-1.5 rounded-full uppercase tracking-tighter">Out of Stock</span>
                    <?php endif; ?>
                </div>

                <div class="mt-6 px-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1"><?php echo $row['category']; ?></p>
                            <h4 class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars($row['name']); ?></h4>
                        </div>
                        <p class="text-xl font-black text-slate-900">$<?php echo number_format($row['price'], 2); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <p class="text-slate-400 text-sm font-medium">&copy; 2026 Dita Store Admin System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>