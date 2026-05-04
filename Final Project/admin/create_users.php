<?php
// 1. DATABASE AND LOGIC FIRST
include('includes/connect.php');

if (isset($_POST['save_user'])) {
    // Mapping to your specific table columns: first_name, last_name, email, password, role
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Taking the pre-hashed password directly
    $role = $_POST['role']; // Must be 'admin' or 'customer'[cite: 1]

    try {
        $query = "INSERT INTO users (first_name, last_name, email, password, role) 
                  VALUES (:first_name, :last_name, :email, :password, :role)";
        
        $stmt = $pdo->prepare($query); 
        $stmt->execute([
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'password'   => $password, // Direct insertion
            'role'       => $role
        ]);

        header("Location: users.php?msg=user_added");
        exit();
    } catch (PDOException $e) {
        $error = "Error: Email already exists or database error.";
    }
}

// 2. UI SECTION
include('includes/header.php'); 
?>

<div class="max-w-2xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <div class="flex items-center gap-4 mb-8">
        <a href="users.php" class="text-slate-400 hover:text-slate-600 transition-colors">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-black text-slate-800">Add New User</h2>
    </div>

    <?php if(isset($error)): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-bold border-l-4 border-red-500">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" class="space-y-6">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">First Name</label>
                <input type="text" name="first_name" required placeholder="Daris"
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Last Name</label>
                <input type="text" name="last_name" required placeholder="Hodza"
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Email Address</label>
            <input type="email" name="email" required placeholder="admin@example.com"
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Password (Pre-Hashed)</label>
                <input type="password" name="password" required 
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Role</label>
                <select name="role" class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                    <option value="admin">Administrator</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
        </div>

        <button type="submit" name="save_user" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 mt-4">
            Create Account
        </button>
    </form>
</div>

<?php include('includes/footer.php'); ?>