<?php
include 'admin/includes/db_connect.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check users table for the email 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role']; 

        // Role-based redirection 
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="login-container">
    <div class="login-box">
        <h1>LOGIN</h1>
        <?php if($error): ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="input-group">
                <input type="email" name="email" placeholder="EMAIL" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="PASSWORD" required>
            </div>
            <button type="submit" class="btn-login">SIGN IN</button>
        </form>
        <p class="form-footer">Don't have an account? <a href="register.php">CREATE ONE</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>