<?php 
// session_start() is already at the top of your file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAISON | Modern Fashion</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="announcement-bar">
        FREE SHIPPING ON ORDERS OVER $100
    </div>
    
    <nav class="main-nav">
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="shop.php">SHOP ALL</a>
            <a href="shop.php?category=1">WOMEN</a>
            <a href="shop.php?category=2">MEN</a>
        </div>
        
        <div class="logo"><a href="index.php">MAISON</a></div>
        
        <div class="nav-icons">
            <a href="#" class="icon"><i class="fa-solid fa-magnifying-glass"></i></a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <span class="user-welcome">HI, <?php echo strtoupper($_SESSION['first_name']); ?></span>
                
                <?php if($_SESSION['role'] === 'admin'): ?>
                    <a href="admin/index.php" class="admin-link">PANEL</a>
                <?php endif; ?>
                
                <a href="logout.php" class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            <?php else: ?>
                <a href="login.php" class="icon"><i class="fa-regular fa-user"></i></a>
            <?php endif; ?>

            <a href="cart.php" class="icon cart-icon-wrapper">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">
                    <?php 
                        $count = 0;
                        if(isset($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $item) {
                                $count += $item['quantity'];
                            }
                        }
                        echo $count;
                    ?>
                </span>
            </a>
        </div>
    </nav>
