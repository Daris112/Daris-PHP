<?php
// 1. Security Gatekeeper
session_start();

// Ensure ONLY admins can view this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// 2. Inclusion of UI and Database
include('includes/header.php'); // Your admin-specific header
include('includes/connect.php'); // Your admin-specific DB connect

// 3. Fetch Dashboard Statistics
try {
    // Total Inventory Count
    $stmtProducts = $pdo->query("SELECT COUNT(*) as total FROM products");
    $productCount = $stmtProducts->fetch();

    // Latest 5 products with Category Names
    $queryRecent = "SELECT p.*, c.name as category_name 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC LIMIT 5";
    $stmtRecent = $pdo->prepare($queryRecent);
    $stmtRecent->execute();
    $recentProducts = $stmtRecent->fetchAll();
} catch (PDOException $e) {
    // In production, log this rather than die()
    error_log($e->getMessage());
    echo "An error occurred loading the dashboard statistics.";
}
?>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
        <h3 class="font-black uppercase tracking-tighter text-lg text-slate-800">Recently Added</h3>
        <a href="inventory.php" class="text-[10px] font-black uppercase text-blue-600 tracking-widest">View All</a>
    </div>
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
                <?php if (count($recentProducts) > 0): ?>
                    <?php foreach($recentProducts as $item): ?>
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                                    <?php if ($item['image_url']): ?>
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
                            <a href="edit_product.php?id=<?php echo $item['id']; ?>" class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black uppercase rounded-full hover:bg-black hover:text-white transition-all">Edit</a>
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
</div>