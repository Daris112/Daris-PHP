<?php
// 1. Security Gatekeeper & Session Start
// We include the header which contains session_start() and the login check
include('includes/header.php'); 

// 2. Database Connection
// Since we are in the admin folder, we include the local connect file
include('includes/connect.php'); 

// 3. Fetch Dashboard Statistics
try {
    // Get total product count
    $stmtProducts = $pdo->query("SELECT COUNT(*) as total FROM products");
    $productCount = $stmtProducts->fetch();

    // Fetch the latest 5 products to display in a "Recent Activity" table
    $queryRecent = "SELECT p.*, c.name as category_name 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC LIMIT 5";
    $stmtRecent = $pdo->prepare($queryRecent);
    $stmtRecent->execute();
    $recentProducts = $stmtRecent->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!-- The header.php already contains the <html>, <head>, and opening <body> tags -->

<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <header class="mb-10">
        <h2 class="text-4xl font-black text-slate-800 uppercase tracking-tighter italic">
            Dashboard
        </h2>
        <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mt-2">
            Welcome back, <?php echo htmlspecialchars($_SESSION['first_name']); ?>
        </p>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-transform hover:-translate-y-1">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Total Inventory</p>
            <h3 class="text-4xl font-black text-slate-800"><?php echo $productCount['total']; ?> Items</h3>
        </div>

        <div class="bg-black p-8 rounded-[2rem] shadow-xl text-white md:col-span-2 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold mb-2">Management Quick Actions</h3>
                <p class="text-slate-400 text-sm mb-6">Update your catalog or review store performance.</p>
            </div>
            <div class="flex gap-4">
                <a href="inventory.php" class="bg-white text-black px-6 py-3 rounded-xl font-bold text-xs uppercase hover:bg-slate-100 transition-all">
                    Manage Products
                </a>
                <a href="../index.php" target="_blank" class="border border-slate-700 px-6 py-3 rounded-xl font-bold text-xs uppercase hover:bg-slate-800 transition-all">
                    Live Storefront <i class="fas fa-external-link-alt ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Products Table -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-black uppercase tracking-tighter text-lg text-slate-800">Recently Added</h3>
            <button class="text-[10px] font-black uppercase text-blue-600 tracking-widest">View All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Product</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Category</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Price</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach($recentProducts as $item): ?>
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                    <i class="fas fa-image text-xs"></i>
                                </div>
                                <span class="font-bold text-slate-700"><?php echo htmlspecialchars($item['name']); ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-medium text-slate-500">
                            <?php echo htmlspecialchars($item['category_name'] ?? 'Uncategorized'); ?>
                        </td>
                        <td class="px-8 py-5 font-black text-slate-900">
                            $<?php echo number_format($item['price'], 2); ?>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-full">Active</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</main> <!-- Closing main tag from header.php -->
</div> <!-- Closing flexbox div from header.php -->
</body>
</html>