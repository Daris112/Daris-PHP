<?php 
// Start database and session
require_once 'includes/db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison | Modern Fashion</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="margin: 0; padding: 0; font-family: 'Montserrat', sans-serif; background-color: #fdfcfb;">

    <!-- Top Announcement Bar -->
    <div style="background: #2b2b2b; color: #fff; font-size: 10px; text-align: center; padding: 10px; letter-spacing: 2px; text-transform: uppercase;">
        Shipping on orders over $100 | New arrivals every week | Easy returns within 30 days[cite: 1]
    </div>

    <?php 
    // Include the separated Navbar
    include 'includes/navbar.php'; 

    // Include the Hero Header (Home Page Only)
    include 'includes/hero.php'; 
    ?>

    <!-- Explore Categories Section -->
    <section style="padding: 80px 40px; text-align: center;">
        <p style="color: #c9ab81; letter-spacing: 3px; font-size: 12px; text-transform: uppercase; margin-bottom: 10px;">Explore</p>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 400; margin-bottom: 50px;">Shop by Category[cite: 1]</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto;">
            <div style="background: #d4c5b6; height: 450px; display: flex; align-items: flex-end; padding: 30px; position: relative;">
                <a href="category.php?type=women" style="color: #fff; text-decoration: none; font-family: 'Playfair Display'; font-size: 28px;">Women</a>
            </div>
            <div style="background: #4a4846; height: 450px; display: flex; align-items: flex-end; padding: 30px;">
                <a href="category.php?type=men" style="color: #fff; text-decoration: none; font-family: 'Playfair Display'; font-size: 28px;">Men</a>
            </div>
            <div style="background: #bca686; height: 450px; display: flex; align-items: flex-end; padding: 30px;">
                <a href="category.php?type=accessories" style="color: #fff; text-decoration: none; font-family: 'Playfair Display'; font-size: 28px;">Accessories</a>
            </div>
        </div>
    </section>

    <!-- Footer could be included here -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>