<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAISON | Modern Fashion</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="announcement-bar">
        FREE SHIPPING ON ORDERS OVER $100
    </div>
    
    <nav class="main-nav">
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="category.php?id=1">WOMEN</a>
            <a href="category.php?id=2">MEN</a>
            <a href="category.php?id=3">ACCESSORIES</a>
        </div>
        
        <div class="logo">MAISON</div>
        
        <div class="nav-icons">
            <a href="#" class="icon">Q</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php">LOGOUT</a>
            <?php else: ?>
                <a href="login.php">LOGIN</a>
            <?php endif; ?>
            <a href="cart.php">CART</a>
        </div>
    </nav>