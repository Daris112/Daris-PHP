<?php
include('includes/connect.php');
include('includes/header.php');

// Fetch all products
$query = "SELECT * FROM products ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();
?>

<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-800">Product Inventory</h1>
            <p class="text-slate-500">Manage your clothing store stock and pricing.</p>
        </div>
        <a href="create.php" class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Product</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Category</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Price</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Stock</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach($products as $row): ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                <i class="fas fa-image"></i>
                            </div>
                            <span class="font-bold text-slate-700"><?php echo htmlspecialchars($row['name']); ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500"><?php echo htmlspecialchars($row['category']); ?></td>
                    <td class="px-8 py-5 font-bold text-slate-700">$<?php echo number_format($row['price'], 2); ?></td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo $row['stock'] < 10 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'; ?>">
                            <?php echo $row['stock']; ?> in stock
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this product?')"
                               class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all">
                                <i class="fas fa-trash text-xs"></i>
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