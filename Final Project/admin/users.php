<?php
include('includes/connect.php');
include('includes/header.php');

// Fetch all users from the database
$query = "SELECT id, username, email, role, created_at FROM users ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-800">User Management</h1>
            <p class="text-slate-500">Manage administrative access and permissions.</p>
        </div>
        <a href="create_users.php" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
            <i class="fas fa-user-plus mr-2"></i> Add New Admin
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Administrator</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Email Address</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Role</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Joined Date</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach($users as $user): ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                            </div>
                            <span class="font-bold text-slate-700"><?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600">
                            <?php echo htmlspecialchars($user['role']); ?>
                        </span>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-400">
                        <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <a href="delete_users.php?id=<?php echo $user['id']; ?>" 
                           onclick="return confirm('Are you sure you want to remove this admin?')"
                           class="text-red-400 hover:text-red-600 transition-colors px-4">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('includes/footer.php'); ?>