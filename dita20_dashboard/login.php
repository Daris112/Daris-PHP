<?php
session_start();
include("includes/connect.php");

$errors = array();

// If already logged in, skip login page
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        array_push($errors, "Please enter both username and password");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // SUCCESS: Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            
            // Redirect to dashboard
            header('Location: index.php');
            exit();
        } else {
            array_push($errors, "Invalid username or password");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Dita Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: radial-gradient(circle at top right, #1e293b, #0f172a); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>
    <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-md mx-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mx-auto mb-4">
                <i class="fas fa-bolt"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-800">Dita Login</h1>
        </div>

        <?php if (count($errors) > 0): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <?php foreach ($errors as $error): ?>
                    <p class="text-red-700 text-sm font-bold"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Username</label>
                <input type="text" name="username" class="w-full px-4 py-3 bg-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
            <button type="submit" name="login" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold uppercase tracking-widest hover:bg-blue-700 transition-all">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>