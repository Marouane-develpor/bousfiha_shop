-- Database: `bousfiha_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `created_at`) VALUES
(1, 'demo@electrobousfiha.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Demo User', '2023-01-01 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`) VALUES
(1, 'TV', 'tv', 'fas fa-tv'),
(2, 'Gros Electroménager', 'gros-electromenager', 'fas fa-snowflake'),
(3, 'Petit Electroménager', 'petit-electromenager', 'fas fa-blender'),
(4, 'Encastrable', 'encastrable', 'fas fa-burn'),
(5, 'Smartphone', 'smartphone', 'fas fa-mobile-alt'),
(6, 'Informatique', 'informatique', 'bi bi-usb-symbol'),
(7, 'Gaming', 'gaming', 'fas fa-gamepad'),
(8, 'Audio', 'audio', 'fa-solid fa-radio');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL, -- keeping denormalized for compatibility with existing code structure
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `badge` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_name`, `price`, `old_price`, `image`, `badge`) VALUES
(101, 'Smart TV LG OLED 65" 4K', 'TV', 15000.00, 18000.00, 'assets/images/lg_tv.png', 'Promo'),
(102, 'Réfrigérateur Samsung Side-by-Side', 'Gros Electroménager', 12000.00, 14000.00, 'assets/images/samsung_fridge.png', 'Top Vente'),
(103, 'Lave-linge Beko 9kg', 'Gros Electroménager', 3500.00, 4200.00, 'assets/images/beko_washer.png', 'Promo'),
(104, 'Pack Encastrable Four + Plaque', 'Encastrable', 2800.00, NULL, 'assets/images/oven_pack.png', NULL),
(201, 'Blender Moulinex 1.5L', 'Petit Electroménager', 450.00, 600.00, 'assets/images/blender.png', NULL),
(202, 'Air Fryer Ninja', 'Petit Electroménager', 1200.00, 1500.00, 'assets/images/ninja_air_fryer.png', 'Nouveau'),
(203, 'Smartphone Galaxy S23', 'Smartphone', 8500.00, 9000.00, 'https://placehold.co/400x400?text=Galaxy+S23', NULL),
(204, 'PS5 Slim Standard', 'Gaming', 6000.00, NULL, 'https://placehold.co/400x400?text=PS5', 'Stock Limité'),
(301, 'MacBook Air M2', 'Informatique', 13500.00, 15000.00, 'assets/images/macbook_air_m2.png', 'Promo'),
(302, 'Casque Sony WH-1000XM5', 'Audio', 3800.00, NULL, 'https://placehold.co/400x400?text=Sony+Headphones', 'Top Son'),
(303, 'Machine à Expresso Delonghi', 'Petit Electroménager', 2200.00, 2800.00, 'https://placehold.co/400x400?text=Expresso', '-20%'),
(304, 'Tablette Samsung Tab S9', 'Informatique', 8900.00, NULL, 'https://placehold.co/400x400?text=Tab+S9', 'Nouveau'),
(305, 'Lave-vaisselle Whirlpool', 'Gros Electroménager', 4500.00, 5200.00, 'https://placehold.co/400x400?text=Dishwasher', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
