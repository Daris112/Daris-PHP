-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2026 at 12:32 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothingstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Women'),
(2, 'Men'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `shipping_address` text,
  `city` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','shipped','delivered') DEFAULT 'pending',
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_address`, `city`, `zip_code`, `total_amount`, `status`, `order_date`) VALUES
(1, NULL, 'Daris Hodza, dadzadadzd, prizren', NULL, NULL, 20.00, 'pending', '2026-05-16 14:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text,
  `sizes` varchar(255) DEFAULT 'S,M,L,XL',
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`, `description`, `sizes`, `category_id`) VALUES
(1, 'Luxury silk shirt', 20.00, 'luxury-silk-shirt.jpg', 'a luxury white silk shirt made from premium materials', 'S,M,L,XL', 2),
(2, 'Silk Slip Dress', 210.00, 'silk-dress.jpg', 'Fluid silhouette crafted from sand-washed silk. Features a subtle sheen and delicate, adjustable straps.', 'S,M,L,XL', 1),
(3, 'Tailored Blazer', 285.00, 'women-blazer.jpg', 'A sharp, double-breasted jacket made from structured wool blend with clean shoulder lines.', 'S,M,L,XL', 1),
(4, 'Cashmere Crewneck', 165.00, 'cashmere-crew.jpg', 'Ultra-soft knitted sweater sourced from premium Mongolian cashmere. Breathable yet insulating.', 'S,M,L,XL', 1),
(5, 'Wide-Leg Pleated Trousers', 145.00, 'wide-trousers.jpg', 'High-waisted trousers with precise front pleats, cut from a fluid drape fabric for effortless motion.', 'S,M,L,XL', 1),
(6, 'Oversized Poplin Shirt', 95.00, 'poplin-shirt.jpg', 'Crisp 100% organic cotton poplin with a dropped shoulder and an elongated hem.', 'S,M,L,XL', 1),
(7, 'Ribbed Knit Midi Skirt', 120.00, 'midi-skirt.jpg', 'Form-fitting column skirt in a heavy-gauge rib knit, featuring an elasticated waistband.', 'S,M,L,XL', 1),
(8, 'Linen Wrap Top', 85.00, 'linen-top.jpg', 'Lightweight, breathable Belgian linen featuring a clean wrap-around design and side tie.', 'S,M,L,XL', 1),
(9, 'Minimalist Trench Coat', 320.00, 'trench-coat.jpg', 'Water-resistant gabardine cotton trench with a concealed button placket and matching waist tie.', 'S,M,L,XL', 1),
(10, 'Asymmetric Jersey Top', 70.00, 'jersey-top.jpg', 'Sculptural off-the-shoulder top in a dense, stretchy modal jersey that holds its shape.', 'S,M,L,XL', 1),
(11, 'Fine Wool Cardigan', 135.00, 'wool-cardigan.jpg', 'Cropped silhouette with a deep V-neckline and genuine mother-of-pearl buttons.', 'S,M,L,XL', 1),
(12, 'Denim Column Dress', 160.00, 'denim-dress.jpg', 'Rigid organic denim midi dress with a straight neck and a clean, raw-edge finish.', 'S,M,L,XL', 1),
(13, 'Silk Organza Blouse', 180.00, 'organza-blouse.jpg', 'Sheer, ethereal blouse with a structured collar and understated button details.', 'S,M,L,XL', 1),
(14, 'Relaxed Linen Trousers', 110.00, 'linen-trousers.jpg', 'Easy-fitting summer trousers with a drawstring waist, crafted entirely from washed linen.', 'S,M,L,XL', 1),
(15, 'Sculpted Rib Tank', 45.00, 'rib-tank.jpg', 'An elevated wardrobe staple in a heavyweight cotton-spandex blend with a high neck racer back.', 'S,M,L,XL', 1),
(16, 'Merino Mockneck', 115.00, 'mockneck.jpg', 'Lightweight extrafine merino wool top designed for layering during transitional seasons.', 'S,M,L,XL', 1),
(17, 'Tailored Wool Trousers', 155.00, 'men-trousers.jpg', 'Impeccably tailored trousers in a soft wool blend. Features a clean flat-front and button-through rear pockets.', 'S,M,L,XL', 2),
(18, 'Structured Overcoat', 350.00, 'wool-overcoat.jpg', 'Heavyweight recycled wool blend coat with a straight drop, notch lapels, and full lining.', 'S,M,L,XL', 2),
(19, 'Heavyweight Tee', 50.00, 'heavy-tee.jpg', 'Boxy fit t-shirt constructed from dense 280gsm organic cotton with a durable ribbed collar.', 'S,M,L,XL', 2),
(20, 'Cuban Collar Linen Shirt', 90.00, 'cuban-shirt.jpg', 'Relaxed-fit short sleeve shirt with an open collar, perfect for warm-weather layering.', 'S,M,L,XL', 2),
(21, 'Selvedge Denim Jeans', 175.00, 'selvedge-denim.jpg', 'Straight-leg jeans crafted from raw 13oz Japanese selvedge denim. Designed to break in beautifully over time.', 'S,M,L,XL', 2),
(22, 'Merino Knit Polo', 130.00, 'knit-polo.jpg', 'Fine-gauge merino wool polo sweater with a clean three-button placket and ribbed cuffs.', 'S,M,L,XL', 2),
(23, 'Suede Bomber Jacket', 420.00, 'suede-bomber.jpg', 'Ultra-soft, ethically sourced calf suede jacket featuring minimalist hardware and a sleek satin lining.', 'S,M,L,XL', 2),
(24, 'Oxford Button Down', 85.00, 'oxford-shirt.jpg', 'Timeless shirt in a heavy Oxford weave with a perfectly proportioned roll collar.', 'S,M,L,XL', 2),
(25, 'Relaxed Pleated Shorts', 75.00, 'pleated-shorts.jpg', 'Knee-length shorts cut from a cotton-twill blend with subtle front pleats for an elevated casual look.', 'S,M,L,XL', 2),
(26, 'Cashmere Hoodie', 220.00, 'cashmere-hoodie.jpg', 'Lounge piece redefined. Pure cashmere knit hoodie with clean, stitch-less drawstrings.', 'S,M,L,XL', 2),
(27, 'Technical Mac Coat', 295.00, 'mac-coat.jpg', 'Sleek, windproof, and waterproof rain coat featuring a minimalist silhouette and hidden zippers.', 'S,M,L,XL', 2),
(28, 'Waffle Knit Crewneck', 95.00, 'waffle-crew.jpg', 'Textured thermal sweater in a midweight organic cotton weave, ideal for effortless weekend wear.', 'S,M,L,XL', 2),
(29, 'Slim Chino Trousers', 115.00, 'chino-trousers.jpg', 'Tailored cotton-gabardine chinos with a touch of stretch for day-long comfort.', 'S,M,L,XL', 2),
(30, 'Chore Jacket', 140.00, 'chore-jacket.jpg', 'Utilitarian outer layer made from rugged cotton canvas with three clean patch pockets.', 'S,M,L,XL', 2),
(31, 'Supima Cotton Vest', 40.00, 'supima-vest.jpg', 'Premium tank top with a subtle scoop neck, constructed from extra-long staple Supima cotton.', 'S,M,L,XL', 2),
(32, 'Leather Tote Bag', 245.00, 'leather-tote.jpg', 'Unlined grain leather tote with a structured base, raw interior, and a detachable internal zip pouch.', 'S,M,L,XL', 3),
(33, 'Acetate Sunglasses', 125.00, 'sunglasses.jpg', 'Square-frame sunglasses handcrafted from bio-acetate with complete UV400 protective lenses.', 'S,M,L,XL', 3),
(34, 'Minimalist Cardholder', 55.00, 'cardholder.jpg', 'Slim Italian calfskin leather wallet with four card slots and a central note compartment.', 'S,M,L,XL', 3),
(35, 'Silk Square Scarf', 75.00, 'silk-scarf.jpg', 'Pure silk twill scarf measuring 70x70cm, detailed with hand-rolled edges and a subtle monochromatic border.', 'S,M,L,XL', 3),
(36, 'Classic Leather Belt', 65.00, 'leather-belt.jpg', 'Full-grain vegetable-tanned leather belt finished with a brushed silver buckle.', 'S,M,L,XL', 3),
(37, 'Merino Wool Beanie', 45.00, 'wool-beanie.jpg', 'Double-layer ribbed beanie knitted from soft, non-scratchy extrafine merino wool.', 'S,M,L,XL', 3),
(38, 'Silver Band Ring', 90.00, 'silver-ring.jpg', 'Solid 925 sterling silver band with a raw, brushed texture and a discreet internal hallmark.', 'S,M,L,XL', 3),
(39, 'Canvas Weekend Bag', 185.00, 'weekend-bag.jpg', 'Heavy-duty water-repellent duck canvas duffel accented with black leather handles and trim.', 'S,M,L,XL', 3),
(40, 'Ribbed Cotton Socks', 20.00, 'cotton-socks.jpg', 'High-comfort mid-calf socks woven from a combed cotton blend with targeted sole cushioning.', 'S,M,L,XL', 3),
(41, 'Minimalist Wristwatch', 260.00, 'wristwatch.jpg', '38mm brushed steel case housing a clean dial, reliable Japanese quartz movement, and a black leather strap.', 'S,M,L,XL', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'daris', 'hodza', 'darishodza12@gmail.com', '$2y$10$yKzUwx8/wgXIBvy.0iLwb.sBMGw9dSfK16Yj1MTNXPXhusgKaBaGO', NULL, NULL, 'admin', '2026-05-04 12:09:56'),
(2, 'Eldar', 'Hodza', 'hodzaeldar13@gmail.com', '$2y$10$5ll8/d8c.fnAFLfAN4rUG.38wZ2LmdYt5w7KM2WkK/tyC2jpzJQHi', NULL, NULL, 'customer', '2026-05-04 14:44:31'),
(3, 'Emil', 'Hodza', 'hodzaemil@gmail.com', '$2y$10$HDV1lQY0dwFKe9U8LCjQj.MoTOy.r/PgaoO1mSc7KvYtCYxy525k6', NULL, NULL, 'customer', '2026-05-07 15:06:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`order_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
