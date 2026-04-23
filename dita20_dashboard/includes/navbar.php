<nav class="sticky top-0 z-30 flex items-center justify-between px-8 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100">
    
    <div class="flex items-center gap-8">
        <h2 class="text-slate-800 font-bold text-lg hidden md:block">
            <?php 
                // Displays the name of the current file as a title
                echo ucfirst(str_replace('.php', '', basename($_SERVER['PHP_SELF']))); 
            ?>
        </h2>
        
        <div class="relative w-72 hidden lg:block">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
            <input type="text" placeholder="Search data..." 
                   class="w-full bg-slate-100/50 border-none rounded-2xl pl-12 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
        </div>
    </div>

    <div class="flex items-center gap-6">
        
        <button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-slate-100 hover:text-blue-600 transition-all relative">
            <i class="far fa-bell text-lg"></i>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        <div class="w-px h-6 bg-slate-200"></div>

        <div class="flex items-center gap-3 group cursor-pointer">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-black text-slate-800 leading-none">
                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>
                </p>
                <p class="text-[10px] font-bold text-blue-600 uppercase mt-1">Full Access</p>
            </div>
            
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-200 group-hover:scale-105 transition-transform">
                <span class="font-bold text-sm">
                    <?php echo strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)); ?>
                </span>
            </div>
        </div>
    </div>
</nav>