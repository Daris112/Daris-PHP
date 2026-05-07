<?php
session_start();
require_once 'admin/includes/connect.php';

$errors = array();
$success = false;

if (isset($_POST['register'])) {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        array_push($errors, "All fields are required.");
    }

    if ($password !== $confirm_password) {
        array_push($errors, "Passwords do not match.");
    }

    if (count($errors) == 0) {
        try {
            // Check if email already exists
            $checkEmail = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $checkEmail->execute([$email]);
            
            if ($checkEmail->rowCount() > 0) {
                array_push($errors, "This email is already registered.");
            } else {
                // Hash password using BCRYPT to match your DB dump
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                // Insert into database (role defaults to 'customer' as per your SQL)
                $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute([$first_name, $last_name, $email, $hashed_password])) {
                    $success = true;
                }
            }
        } catch (PDOException $e) {
            array_push($errors, "Registration failed: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAISON | Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-black: #000000;
            --bg-gray: #fcfcfc;
            --accent-gray: #999999;
            --border: #e2e2e2;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg-gray);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .register-card {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            padding: 50px 45px;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .brand-logo {
            text-align: center;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 10px;
            color: var(--primary-black);
            margin-bottom: 8px;
            display: block;
        }

        .brand-tagline {
            text-align: center;
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: var(--accent-gray);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 35px;
        }

        /* Success & Error Messages */
        .msg-container { padding: 12px 16px; margin-bottom: 25px; border-radius: 12px; font-size: 13px; font-weight: 600; text-align: center; }
        .error-msg { background: #fff5f5; color: #c92a2a; border: 1px solid #ffc9c9; }
        .success-msg { background: #f2fcf5; color: #2b8a3e; border: 1px solid #b2f2bb; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

        .form-group { margin-bottom: 20px; }
        .full-width { grid-column: span 2; }

        .form-group label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            background: #f9f9f9;
            border: 1.5px solid transparent;
            border-radius: 14px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            background: #fff;
            border-color: var(--primary-black);
        }

        .register-btn {
            width: 100%;
            padding: 18px;
            background: var(--primary-black);
            color: #fff;
            border: none;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .register-btn:hover { background: #222; transform: translateY(-2px); }

        .footer-links { margin-top: 30px; text-align: center; font-size: 13px; color: var(--accent-gray); }
        .footer-links a { color: var(--primary-black); text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>

    <div class="register-card">
        <span class="brand-logo">MAISON</span>
        <span class="brand-tagline">Create your profile</span>

        <?php if (count($errors) > 0): ?>
            <div class="msg-container error-msg">
                <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
            </div>
        <?php elseif ($success): ?>
            <div class="msg-container success-msg">
                Account created successfully. <a href="login.php" style="color:#2b8a3e">Login here</a>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Daris" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Hodza" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="example@maison.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="••••••••" required>
            </div>

            <button type="submit" name="register" class="register-btn">Join Maison</button>
        </form>

        <div class="footer-links">
            Already have an account? <a href="login.php">Sign In</a>
        </div>
    </div>

</body>
</html>