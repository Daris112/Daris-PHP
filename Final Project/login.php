<?php
session_start();
require_once 'admin/includes/connect.php'; 

$errors = array();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        array_push($errors, "Please fill in all fields.");
    }

    if (count($errors) == 0) {
        try {
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $userRole = strtolower(trim($user['role']));

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''));
                $_SESSION['role'] = $userRole;
                
                if ($userRole === 'admin') {
                    header("Location: admin/index.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                array_push($errors, "Incorrect email or password.");
            }
        } catch (PDOException $e) {
            array_push($errors, "Connection failed.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAISON | Account Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-black: #000000;
            --bg-gray: #fcfcfc;
            --accent-gray: #999999;
            --border: #e2e2e2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-gray);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            padding: 60px 45px;
            border-radius: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .brand-logo {
            text-align: center;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 12px;
            color: var(--primary-black);
            margin-bottom: 8px;
            display: block;
        }

        .brand-tagline {
            text-align: center;
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--accent-gray);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 40px;
        }

        .error-container {
            background: #fff5f5;
            border-left: 3px solid #f03e3e;
            padding: 12px 16px;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        .error-text {
            color: #c92a2a;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #333;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            background: #f9f9f9;
            border: 1.5px solid transparent;
            border-radius: 16px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            background: #fff;
            border-color: var(--primary-black);
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background: var(--primary-black);
            color: #fff;
            border: none;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #222;
            transform: translateY(-2px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .footer-links {
            margin-top: 35px;
            text-align: center;
            font-size: 13px;
            color: var(--accent-gray);
        }

        .footer-links a {
            color: var(--primary-black);
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <span class="brand-logo">MAISON</span>
        <span class="brand-tagline">Modern Lifestyle</span>

        <?php if (count($errors) > 0): ?>
            <div class="error-container">
                <?php foreach ($errors as $error): ?>
                    <p class="error-text"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" name="login" class="login-btn">Sign In</button>
        </form>

        <div class="footer-links">
            Don't have an account? <a href="register.php">Create Account</a>
        </div>
    </div>

</body>
</html>