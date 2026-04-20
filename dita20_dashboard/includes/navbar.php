<nav class="sticky top-0 z-30 flex items-center justify-between px-8 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100">
    
    <div class="relative w-96 hidden md:block">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
        <input type="text" placeholder="Global search commands..." 
               class="w-full bg-slate-100/50 border-none rounded-2xl pl-12 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
    </div>

    <div class="flex items-center gap-6">
        <button class="relative text-slate-400 hover:text-slate-600 transition-colors">
            <i class="far fa-bell text-xl"></i>
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">3</span>
        </button>

        <div class="w-px h-6 bg-slate-200"></div>

        <div class="flex items-center gap-4 group cursor-pointer">
            <div class="text-right">
                <p class="text-sm font-black text-slate-800 leading-none"><?php  echo htmlspecialchars($_SESSION['username']); ?></p>
                <p class="text-[10px] font-bold text-blue-600 uppercase mt-1">Super Admin</p>
            </div>
            <img src="https://ui-avatars.com/api/?name=Daris+P&background=0D8ABC&color=fff" 
                 class="w-10 h-10 rounded-2xl shadow-lg shadow-blue-100 group-hover:scale-105 transition-transform">
        </div>
    </div>
</nav>