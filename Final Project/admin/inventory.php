<?php
include('includes/connect.php');
include('includes/header.php');

// Fetch all products with their category names using a JOIN
try {
    $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              ORDER BY p.id DESC";
    
    // Using $pdo from your connection file
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Product Inventory</h1>
            <p class="text-slate-500 font-medium">Manage your clothing store catalog and pricing.</p>
        </div>
        <a href="create.php" class="bg-black text-white px-6 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if(isset($_GET['msg'])): ?>
        <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-2xl border-l-4 border-green-500 font-bold text-sm">
            Action completed successfully.
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Product Details</th>
                    <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Category</th>
                    <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Price</th>
                    <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Management</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach($products as $row): ?>
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-50">
                                <?php if(!empty($row['image_url'])): ?>
                                    <img src="assets/images/<?php echo htmlspecialchars($row['image_url']); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-tshirt text-slate-300"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="block font-bold text-slate-800 group-hover:text-black transition-colors"><?php echo htmlspecialchars($row['name']); ?></span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">ID: #<?php echo $row['id']; ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-xs font-black uppercase tracking-widest text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                            <?php echo htmlspecialchars($row['category_name'] ?? 'Uncategorized'); ?>
                        </span>
                    </td>
                    <td class="px-8 py-5 font-black text-slate-900 tracking-tighter text-lg">
                        $<?php echo number_format($row['price'], 2); ?>
                    </td>
                    <td class="px-8 py-5">
                        <!-- Since your schema doesn't have 'stock' yet, we use a default status[cite: 1] -->
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide bg-green-50 text-green-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-600 hover:bg-black hover:text-white transition-all shadow-sm">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Permanently remove this product from inventory?')"
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('includes/footer.php'); ?>