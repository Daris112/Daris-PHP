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
            --primary-black: #05070d;
            --bg-dark: #080a10;
            --panel: rgba(15, 18, 30, 0.86);
            --panel-light: rgba(255, 255, 255, 0.08);
            --accent: #4fd1c5;
            --accent-soft: rgba(79, 209, 197, 0.18);
            --text-main: #f6f1e8;
            --text-muted: #a5a8b7;
            --border: rgba(255, 255, 255, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background:
                radial-gradient(circle at 20% 20%, rgba(79, 209, 197, 0.16), transparent 28%),
                radial-gradient(circle at 80% 10%, rgba(88, 101, 242, 0.16), transparent 30%),
                linear-gradient(135deg, #05070d 0%, #101320 52%, #07090f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 24px;
            color: var(--text-main);
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            filter: blur(12px);
            opacity: 0.5;
            pointer-events: none;
            animation: floatGlow 9s ease-in-out infinite alternate;
        }

        body::before {
            background: rgba(79, 209, 197, 0.13);
            top: -120px;
            left: -80px;
        }

        body::after {
            background: rgba(89, 99, 140, 0.18);
            right: -110px;
            bottom: -130px;
            animation-delay: -3s;
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: var(--panel);
            width: 100%;
            max-width: 440px;
            padding: 60px 45px;
            border-radius: 28px;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.45);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            animation: cardEntrance 0.8s ease both;
            transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        }

        .login-card:hover {
            transform: translateY(-6px);
            border-color: rgba(79, 209, 197, 0.34);
            box-shadow: 0 38px 110px rgba(0, 0, 0, 0.58);
        }

        .brand-logo {
            text-align: center;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 12px;
            color: var(--text-main);
            margin-bottom: 8px;
            display: block;
            text-shadow: 0 0 26px rgba(79, 209, 197, 0.18);
            animation: fadeSlideDown 0.7s ease 0.15s both;
        }

        .brand-tagline {
            text-align: center;
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 40px;
            animation: fadeSlideDown 0.7s ease 0.25s both;
        }

        .error-container {
            background: rgba(240, 62, 62, 0.12);
            border-left: 3px solid #ff6b6b;
            padding: 12px 16px;
            margin-bottom: 25px;
            border-radius: 8px;
            animation: shakeIn 0.4s ease both;
        }

        .error-text {
            color: #ffb3b3;
            font-size: 13px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
            animation: fadeSlideUp 0.7s ease both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.35s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.45s;
        }

        .form-group label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            font-size: 14px;
            color: var(--text-main);
            outline: none;
            transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input::placeholder {
            color: rgba(246, 241, 232, 0.36);
        }

        .form-group:hover label {
            color: var(--accent);
        }

        .form-group:hover input {
            background: rgba(255, 255, 255, 0.09);
            border-color: rgba(79, 209, 197, 0.28);
            transform: translateY(-2px);
        }

        .form-group input:focus {
            background: rgba(255, 255, 255, 0.11);
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-soft), 0 16px 30px rgba(0, 0, 0, 0.22);
            transform: translateY(-2px);
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #4fd1c5 0%, #9ff5eb 52%, #258f9a 100%);
            color: #080a10;
            border: none;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
            margin-top: 10px;
            box-shadow: 0 14px 32px rgba(79, 209, 197, 0.22);
            animation: fadeSlideUp 0.7s ease 0.55s both;
        }

        .login-btn:hover {
            filter: brightness(1.08);
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 20px 44px rgba(79, 209, 197, 0.34);
        }

        .login-btn:active {
            transform: translateY(0) scale(0.99);
        }

        .footer-links {
            margin-top: 35px;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
            animation: fadeSlideUp 0.7s ease 0.65s both;
        }

        .footer-links a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
            position: relative;
            transition: color 0.25s ease;
        }

        .footer-links a::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -4px;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.25s ease;
        }

        .footer-links a:hover {
            color: #9ff5eb;
        }

        .footer-links a:hover::after {
            transform: scaleX(1);
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeSlideDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatGlow {
            from {
                transform: translate3d(0, 0, 0) scale(1);
            }
            to {
                transform: translate3d(28px, 22px, 0) scale(1.08);
            }
        }

        @keyframes shakeIn {
            0% {
                opacity: 0;
                transform: translateX(-8px);
            }
            60% {
                opacity: 1;
                transform: translateX(4px);
            }
            100% {
                transform: translateX(0);
            }
        }

        @media (max-width: 520px) {
            .login-card {
                padding: 46px 26px;
                border-radius: 24px;
            }

            .brand-logo {
                font-size: 28px;
                letter-spacing: 8px;
            }
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
