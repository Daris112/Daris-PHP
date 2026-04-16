<aside class="w-72 bg-slate-900 text-slate-400 flex flex-col sticky top-0 h-screen hidden lg:flex border-r border-slate-800">
    <div class="p-8 flex items-center gap-3">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
            <i class="fas fa-bolt text-sm"></i>
        </div>
        <span class="text-white font-black tracking-tighter text-xl uppercase">Dita Admin</span>
    </div>

    <nav class="flex-1 px-4 space-y-1">
        <p class="px-4 text-[10px] font-black uppercase tracking-widest text-slate-600 mb-2">Main Menu</p>
        
        <a href="index.php" class="flex items-center gap-4 px-4 py-3 rounded-xl text-white bg-white/5 font-semibold group transition-all">
            <i class="fas fa-chart-pie text-blue-500 group-hover:scale-110 transition-transform"></i>
            <span>Dashboard</span>
        </a>

        <a href="inventory.php" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/5 hover:text-white transition-all">
            <i class="fas fa-boxes"></i>
            <span>Inventory</span>
        </a>

        <a href="users.php" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/5 hover:text-white transition-all">
            <i class="fas fa-user-friends"></i>
            <span>User Management</span>
        </a>
    </nav>

    <div class="p-6 border-t border-slate-800">
        <div class="bg-slate-800/50 p-4 rounded-2xl flex items-center gap-3">
            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
            <span class="text-xs font-bold text-slate-300 tracking-wide uppercase">System v2.4</span>
        </div>
    </div>
</aside>