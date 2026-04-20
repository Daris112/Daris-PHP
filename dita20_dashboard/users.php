
<?php include('includes/header.php'); ?>
<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">User Management</h2>
    <p class="text-slate-500">Manage administrator roles and customer accounts.</p>
</div>

<div class="glass-card rounded-3xl shadow-xl overflow-hidden border border-white">
    <div class="p-6 border-b border-slate-100 bg-white/50 flex justify-between items-center">
        <div class="relative w-64">
            <i class="fas fa-search absolute left-3 top-2.5 text-slate-300"></i>
            <input type="text" placeholder="Find user..." class="pl-10 pr-4 py-2 w-full rounded-xl border border-slate-200 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold">INVITE USER</button>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-widest font-black">
                <th class="p-5">User</th>
                <th class="p-5">Role</th>
                <th class="p-5">Last Login</th>
                <th class="p-5">Status</th>
                <th class="p-5 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <tr class="hover:bg-slate-50 transition-all">
                <td class="p-5">
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Daris+P&background=6366f1&color=fff" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <div class="font-bold text-slate-800"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                            <div class="text-xs text-slate-400 font-medium">daris@example.com</div>
                        </div>
                    </div>
                </td>
                <td class="p-5">
                    <span class="text-xs font-bold text-slate-600 px-2 py-1 bg-slate-100 rounded">Super Admin</span>
                </td>
                <td class="p-5 text-slate-500 text-sm">2 hours ago</td>
                <td class="p-5">
                    <span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-1"></span>
                    <span class="text-xs font-bold text-green-600 uppercase">Online</span>
                </td>
                <td class="p-5 text-center">
                    <button class="text-slate-400 hover:text-red-500 transition"><i class="fas fa-user-minus"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
