<?php
// admin/users.php
include('includes/header.php');
require_once('includes/connect.php');

try {
    // We use first_name to match your database schema
    $query = "SELECT id, first_name, email, role, created_at FROM users ORDER BY id DESC";
    $stmt = $pdo->prepare($query); 
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>

<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Staff Management</h1>
            <p class="text-slate-500 font-medium">Manage administrative access and permissions.</p>
        </div>
        <a href="create_users.php" class="bg-black text-white px-6 py-3 rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
            <i class="fas fa-user-plus mr-2 text-xs"></i> Add New Admin
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Administrator</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Address</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Joined Date</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach($users as $user): ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-xs uppercase">
                                <?php echo substr($user['first_name'], 0, 1); ?>
                            </div>
                            <span class="font-bold text-slate-700"><?php echo htmlspecialchars($user['first_name']); ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500 font-medium"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">
                            <?php echo htmlspecialchars($user['role'] ?? 'Admin'); ?>
                        </span>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-400 font-medium">
                        <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="edit_users.php?id=<?php echo $user['id']; ?>" class="text-slate-400 hover:text-black transition-colors px-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_users.php?id=<?php echo $user['id']; ?>" 
                               onclick="return confirm('Are you sure you want to remove this admin?')"
                               class="text-red-300 hover:text-red-600 transition-colors px-2">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</main></div></body></html>