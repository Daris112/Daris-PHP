<?php
// 1. Security Gatekeeper
session_start();

// Check if user is logged in and is an admin
$role = strtolower(trim($_SESSION['role'] ?? ''));
if (!isset($_SESSION['user_id']) || $role !== 'admin') {
    // We use ../login.php because the admin folder is one level deep
    header("Location: ../login.php");
    exit();
}

// 2. Inclusion of UI and Database
// Ensure these paths are correct relative to the admin folder
include('includes/connect.php'); 
include('includes/header.php'); 

// 3. Fetch Dashboard Statistics
try {
    // Get total product count
    $stmtProducts = $pdo->query("SELECT COUNT(*) as total FROM products");
    $productCount = $stmtProducts->fetch();

    // Fetch the latest 5 products with Category names for the table
    $queryRecent = "SELECT p.*, c.name as category_name 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC LIMIT 5";
    $stmtRecent = $pdo->prepare($queryRecent);
    $stmtRecent->execute();
    $recentProducts = $stmtRecent->fetchAll();

} catch (PDOException $e) {
    // Log error and show a user-friendly message
    error_log($e->getMessage());
    $db_error = "Could not retrieve dashboard data.";
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <header class="mb-10">
        <h2 class="text-4xl font-black text-slate-800 uppercase tracking-tighter italic">
            Dashboard
        </h2>
        <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mt-2">
            Welcome back, <?php echo htmlspecialchars($_SESSION['first_name'] ?? 'Admin'); ?>
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-transform hover:-translate-y-1">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Total Inventory</p>
            <h3 class="text-4xl font-black text-slate-800">
                <?php echo $productCount['total'] ?? '0'; ?> Items
            </h3>
        </div>

        <div class="bg-black p-8 rounded-[2rem] shadow-xl text-white md:col-span-2 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold mb-2">Management Quick Actions</h3>
                <p class="text-slate-400 text-sm mb-6">Update your catalog or review store performance.</p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="inventory.php" class="bg-white text-black px-6 py-3 rounded-xl font-bold text-xs uppercase hover:bg-slate-100 transition-all">
                    Manage Products
                </a>
                <a href="../index.php" target="_blank" class="border border-slate-700 px-6 py-3 rounded-xl font-bold text-xs uppercase hover:bg-slate-800 transition-all">
                    Live Storefront <i class="fas fa-external-link-alt ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-black uppercase tracking-tighter text-lg text-slate-800">Recently Added</h3>
            <a href="inventory.php" class="text-[10px] font-black uppercase text-blue-600 tracking-widest">View All</a>
        </div>
        
        <?php if(isset($db_error)): ?>
            <div class="p-8 text-red-500 text-sm"><?php echo $db_error; ?></div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Product</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Category</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Price</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (!empty($recentProducts)): ?>
                            <?php foreach($recentProducts as $item): ?>
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                                            <?php if (!empty($item['image_url'])): ?>
                                                <img src="../assets/img/<?php echo htmlspecialchars($item['image_url']); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <i class="fas fa-image text-slate-400 text-xs"></i>
                                            <?php endif; ?>
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
                                    <a href="edit_product.php?id=<?php echo $item['id']; ?>" class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black uppercase rounded-full hover:bg-black hover:text-white transition-all">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-slate-400 text-sm italic">
                                    Your inventory is currently empty.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
