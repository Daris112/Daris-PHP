<?php
// 1. Core Includes
include('includes/connect.php'); // Database connection
include('includes/header.php');  // Session security, Head, Sidebar, and Navbar

// 2. Database Queries for Dashboard Stats
try {
    // Total Products Count
    $prodStmt = $conn->query("SELECT COUNT(*) FROM products");
    $totalProducts = $prodStmt->fetchColumn();

    // Total Users Count
    $userStmt = $conn->query("SELECT COUNT(*) FROM users");
    $totalUsers = $userStmt->fetchColumn();

    // Low Stock Alert (Products with less than 10 items)
    $lowStockStmt = $conn->query("SELECT COUNT(*) FROM products WHERE stock < 10");
    $lowStockCount = $lowStockStmt->fetchColumn();

} catch (PDOException $e) {
    // If the tables don't exist yet, default to 0
    $totalProducts = 0;
    $totalUsers = 0;
    $lowStockCount = 0;
}
?>

<div class="max-w-7xl mx-auto">
    
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">System Overview</h1>
            <p class="text-slate-500 font-medium mt-1">Hello, <span class="text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span>. Here is what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-slate-400 bg-slate-100 px-4 py-2 rounded-xl">
                <i class="far fa-calendar-alt mr-2"></i> <?php echo date('M d, Y'); ?>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-500/5 transition-all group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-tshirt text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-widest">Products</span>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Inventory</h3>
            <p class="text-5xl font-black text-slate-800 tracking-tighter"><?php echo $totalProducts; ?></p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Active Admins</h3>
            <p class="text-5xl font-black text-slate-800 tracking-tighter"><?php echo $totalUsers; ?></p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group <?php echo $lowStockCount > 0 ? 'border-red-100 shadow-red-500/5' : ''; ?>">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 <?php echo $lowStockCount > 0 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'; ?> rounded-2xl flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Low Stock Items</h3>
            <p class="text-5xl font-black <?php echo $lowStockCount > 0 ? 'text-red-600' : 'text-slate-800'; ?> tracking-tighter">
                <?php echo $lowStockCount; ?>
            </p>
        </div>

    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h3 class="font-black text-slate-800 text-lg uppercase tracking-tight">Recent Activity</h3>
                <p class="text-xs text-slate-400 font-medium">Quick glance at your latest products</p>
            </div>
            <a href="inventory.php" class="bg-slate-100 text-slate-600 px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">
                Manage Inventory
            </a>
        </div>
        
        <div class="p-16 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-folder-open text-slate-200 text-3xl"></i>
            </div>
            <h4 class="text-slate-800 font-bold mb-2">No product data available</h4>
            <p class="text-slate-400 text-sm max-w-xs mx-auto">Start by adding your first clothing item to the database to see the summary here.</p>
            <a href="create.php" class="inline-block mt-8 text-blue-600 font-bold text-sm hover:underline">
                <i class="fas fa-plus mr-2"></i> Add New Product
            </a>
        </div>
    </div>

</div>

<?php 
// 3. Close the shell
include('includes/footer.php'); 
?>