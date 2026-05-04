<?php
// 1. Core Includes
include('includes/connect.php'); // Database connection
include('includes/header.php');  // Session security, Head, Sidebar, and Navbar

// 2. Database Queries for Dashboard Stats
try {
    // Total Products Count
    $prodStmt = $pdo->query("SELECT COUNT(*) FROM products"); // Changed $conn to $pdo
    $totalProducts = $prodStmt->fetchColumn();

    // Total Users Count (Admins)
    $userStmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
    $totalAdmins = $userStmt->fetchColumn();

    // Total Orders (Since your table doesn't have 'stock' yet)
    $orderStmt = $pdo->query("SELECT COUNT(*) FROM orders");
    $totalOrders = $orderStmt->fetchColumn();

} catch (PDOException $e) {
    $totalProducts = 0;
    $totalAdmins = 0;
    $totalOrders = 0;
}
?>

<div class="max-w-7xl mx-auto">
    
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">System Overview</h1>
            <!-- Using first_name from your DB instead of 'username' -->
            <p class="text-slate-500 font-medium mt-1 text-sm">
                Hello, <span class="text-black font-bold uppercase"><?php echo htmlspecialchars($_SESSION['first_name'] ?? 'Admin'); ?></span>. 
                Welcome back to the MAISON dashboard.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-4 py-2 rounded-xl tracking-widest uppercase">
                <i class="far fa-calendar-alt mr-2 text-blue-500"></i> <?php echo date('M d, Y'); ?>
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        
        <!-- Inventory Card -->
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-800 group-hover:bg-black group-hover:text-white transition-colors">
                    <i class="fas fa-tshirt text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-slate-400 bg-slate-50 px-3 py-1 rounded-full uppercase tracking-widest">Inventory</span>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Products</h3>
            <p class="text-5xl font-black text-slate-800 tracking-tighter"><?php echo $totalProducts; ?></p>
        </div>

        <!-- Admins Card -->
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-800 group-hover:bg-black group-hover:text-white transition-colors">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Active Admins</h3>
            <p class="text-5xl font-black text-slate-800 tracking-tighter"><?php echo $totalAdmins; ?></p>
        </div>

        <!-- Orders Card (Replacing Low Stock) -->
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-800 group-hover:bg-black group-hover:text-white transition-colors">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Orders</h3>
            <p class="text-5xl font-black text-slate-800 tracking-tighter">
                <?php echo $totalOrders; ?>
            </p>
        </div>

    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h3 class="font-black text-slate-800 text-lg uppercase tracking-tight">Recent Activity</h3>
                <p class="text-xs text-slate-400 font-medium">Quick glance at your latest products</p>
            </div>
            <a href="inventory.php" class="bg-black text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all">
                Manage All
            </a>
        </div>
        
        <div class="p-16 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-box-open text-slate-200 text-3xl"></i>
            </div>
            <h4 class="text-slate-800 font-bold mb-2 uppercase tracking-wide text-sm">No recent uploads</h4>
            <p class="text-slate-400 text-xs max-w-xs mx-auto leading-relaxed">Your latest database entries will appear here once you begin adding your collection.</p>
            <a href="create.php" class="inline-block mt-8 text-black font-black text-[10px] uppercase tracking-widest border-b-2 border-black pb-1 hover:text-slate-500 hover:border-slate-500 transition-all">
                <i class="fas fa-plus mr-2"></i> Add New Product
            </a>
        </div>
    </div>

</div>

<?php 
include('includes/footer.php'); 
?>