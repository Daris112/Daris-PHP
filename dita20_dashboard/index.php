<?php include('includes/header.php'); ?>

<?php
    session_start();

    
    if(!isset($_SESSION['username'])){
      
        
        header('location: login.php');
    }
    else{
?>

<?php
session_start();

// If the session variable is not set, redirect to login
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>

<div class="mb-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">System Overview</h2>
            <p class="text-slate-500 font-medium">Here is what's happening with your store today.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Auto-refresh in 5m</span>
            <button class="w-10 h-10 bg-white rounded-full shadow-sm flex items-center justify-center text-slate-400 hover:text-blue-600 transition-all">
                <i class="fas fa-sync-alt text-sm"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-blue-600 p-6 rounded-[2rem] shadow-xl shadow-blue-100 text-white relative overflow-hidden group">
            <i class="fas fa-shopping-bag absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:scale-110 transition-transform"></i>
            <div class="text-blue-100 text-xs font-black uppercase tracking-wider mb-1">Total Revenue</div>
            <div class="text-3xl font-black mb-4">$12,840</div>
            <div class="text-xs bg-white/20 inline-block px-2 py-1 rounded-lg">+12% this week</div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md transition-all">
            <div class="text-slate-400 text-xs font-black uppercase tracking-wider mb-1">Active Orders</div>
            <div class="text-3xl font-black text-slate-800 mb-4">48</div>
            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                <div class="bg-orange-400 h-full w-2/3"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md transition-all">
            <div class="text-slate-400 text-xs font-black uppercase tracking-wider mb-1">Total Customers</div>
            <div class="text-3xl font-black text-slate-800 mb-4">1,204</div>
            <div class="flex -space-x-2">
                <img src="https://i.pravatar.cc/150?u=1" class="w-7 h-7 rounded-full border-2 border-white">
                <img src="https://i.pravatar.cc/150?u=2" class="w-7 h-7 rounded-full border-2 border-white">
                <img src="https://i.pravatar.cc/150?u=3" class="w-7 h-7 rounded-full border-2 border-white">
                <div class="w-7 h-7 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold">+21</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md transition-all">
            <div class="text-slate-400 text-xs font-black uppercase tracking-wider mb-1">Server Status</div>
            <div class="text-3xl font-black text-green-500 mb-4">99.9%</div>
            <div class="flex items-center text-xs font-bold text-slate-400">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span> Optimal Performance
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2">
        <div class="glass-card rounded-[2rem] shadow-xl overflow-hidden bg-white border border-slate-100">
            <div class="p-8 flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Recent Products</h3>
                <a href="inventory.php" class="text-blue-600 font-bold text-sm hover:underline">View All</a>
            </div>
            
            <div class="overflow-x-auto px-4 pb-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-[10px] uppercase font-black tracking-widest border-b border-slate-50">
                            <th class="p-4">Product</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="group hover:bg-slate-50/50 transition-all">
                            <td class="p-4">
                                <div class="font-bold text-slate-700">Minimalist Watch</div>
                                <div class="text-xs text-slate-400">Added 2h ago</div>
                            </td>
                            <td class="p-4 font-black text-slate-800">$189.00</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Stocked</span>
                            </td>
                            <td class="p-4 text-right">
                                <button class="delete-btn text-slate-300 hover:text-red-500 transition-colors" data-name="Minimalist Watch">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-2xl">
            <h3 class="text-lg font-black uppercase tracking-widest mb-6">Live Activity</h3>
            
            <div class="space-y-8 relative before:absolute before:inset-0 before:ml-2 before:-translate-x-px before:h-full before:w-0.5 before:bg-gradient-to-b before:from-slate-700 before:via-slate-800 before:to-transparent">
                <div class="relative pl-8">
                    <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-blue-500 border-4 border-slate-900"></span>
                    <div class="text-sm font-bold text-slate-200">New Order #882</div>
                    <div class="text-xs text-slate-500 mb-1">Just Now</div>
                    <div class="text-xs text-blue-400 font-bold">+$420.00 Expected</div>
                </div>

                <div class="relative pl-8">
                    <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-orange-400 border-4 border-slate-900"></span>
                    <div class="text-sm font-bold text-slate-200">Inventory Alert</div>
                    <div class="text-xs text-slate-500 mb-1">15 mins ago</div>
                    <div class="text-xs text-orange-200 opacity-60">"Leather Belt" is low in stock (2 left)</div>
                </div>

                <div class="relative pl-8">
                    <span class="absolute left-0 top-1 w-4 h-4 rounded-full bg-slate-600 border-4 border-slate-900"></span>
                    <div class="text-sm font-bold text-slate-200">Admin Logged In</div>
                    <div class="text-xs text-slate-500 mb-1">1 hour ago</div>
                    <div class="text-xs text-slate-400 font-medium italic">User: Daris P.</div>
                </div>
            </div>

            <button class="w-full mt-10 py-3 bg-white/5 hover:bg-white/10 rounded-xl text-xs font-bold transition-all border border-white/10 uppercase tracking-widest">
                View All Logs
            </button>
        </div>
    </div>

</div>

<?php } ?>

<?php include('includes/footer.php'); ?>