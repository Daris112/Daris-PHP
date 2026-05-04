<?php
// 1. Security & Layout
include('includes/header.php');
require_once('includes/connect.php');

$message = "";
$user_id = $_GET['id'] ?? null;

if (!$user_id) {
    header("Location: users.php");
    exit();
}

// 2. Handle the Update Request
if (isset($_POST['update_user'])) {
    $first_name = trim($_POST['first_name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    try {
        $update_sql = "UPDATE users SET first_name = :first_name, email = :email, role = :role WHERE id = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute([
            'first_name' => $first_name,
            'email'      => $email,
            'role'       => $role,
            'id'         => $user_id
        ]);
        $message = "User updated successfully!";
    } catch (PDOException $e) {
        $message = "Error updating user: " . $e->getMessage();
    }
}

// 3. Fetch Current User Data to fill the form
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user_data = $stmt->fetch();

    if (!$user_data) {
        die("User not found.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<div class="max-w-3xl mx-auto py-10">
    <div class="mb-8 flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Edit Administrator</h2>
        <a href="users.php" class="text-xs font-black uppercase text-slate-400 hover:text-black">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <?php if($message): ?>
        <div class="mb-6 p-4 bg-blue-50 text-blue-600 rounded-2xl text-[10px] font-black uppercase border-l-4 border-blue-500">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-[3rem] p-12 border border-slate-100 shadow-sm">
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Full Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user_data['first_name']); ?>" required
                       class="w-full px-6 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black border border-transparent font-bold">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required
                       class="w-full px-6 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black border border-transparent font-bold">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Role</label>
                <select name="role" class="w-full px-6 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black border border-transparent font-bold appearance-none">
                    <option value="Admin" <?php echo ($user_data['role'] == 'Admin') ? 'selected' : ''; ?>>Administrator</option>
                    <option value="Staff" <?php echo ($user_data['role'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                    <option value="Editor" <?php echo ($user_data['role'] == 'Editor') ? 'selected' : ''; ?>>Editor</option>
                </select>
            </div>

            <div class="pt-6">
                <button type="submit" name="update_user" class="w-full py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

</main></div></body></html>