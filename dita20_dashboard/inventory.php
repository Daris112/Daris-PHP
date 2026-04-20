
<?php include('includes/header.php'); ?>
<div class="mb-8 flex justify-between items-end">
    <div>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Product Inventory</h2>
        <p class="text-slate-500">Monitor stock levels and warehouse locations.</p>
    </div>
    <div class="flex gap-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg shadow-blue-200">
            <i class="fas fa-plus mr-2"></i> Add Product
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="text-slate-400 text-sm font-bold uppercase mb-2">Total Items</div>
        <div class="text-2xl font-black text-slate-800">1,240</div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="text-orange-400 text-sm font-bold uppercase mb-2">Low Stock</div>
        <div class="text-2xl font-black text-slate-800">12</div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="text-red-400 text-sm font-bold uppercase mb-2">Out of Stock</div>
        <div class="text-2xl font-black text-slate-800">3</div>
    </div>
</div>

<div class="glass-card rounded-3xl shadow-xl overflow-hidden border border-white">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-widest font-black">
                <th class="p-5">Product</th>
                <th class="p-5">Warehouse</th>
                <th class="p-5 text-center">In Stock</th>
                <th class="p-5">Unit Price</th>
                <th class="p-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <tr class="hover:bg-slate-50 transition-all">
                <td class="p-5 font-bold text-slate-700">Wireless Headphones</td>
                <td class="p-5 text-slate-500">Warehouse A (Zone 4)</td>
                <td class="p-5 text-center">
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-bold">55</span>
                </td>
                <td class="p-5 text-slate-900 font-bold">$120.00</td>
                <td class="p-5 text-center">
                    <button class="text-slate-400 hover:text-blue-600"><i class="fas fa-ellipsis-h"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
