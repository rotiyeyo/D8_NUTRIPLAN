-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 07:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutriplan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id_admin` int(11) NOT NULL,
  `username_a` varchar(50) DEFAULT NULL,
  `password_a` varchar(255) DEFAULT NULL,
  `firstname_a` varchar(50) DEFAULT NULL,
  `lastname_a` varchar(50) DEFAULT NULL,
  `email_a` varchar(100) DEFAULT NULL,
  `phonenum_a` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id_admin`, `username_a`, `password_a`, `firstname_a`, `lastname_a`, `email_a`, `phonenum_a`) VALUES
(1, 'admin', '123', 'Admin', 'NutriPlan', 'admin@nutriplan.com', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `allergy_list`
--

CREATE TABLE `allergy_list` (
  `id_allergies` int(11) NOT NULL,
  `allergy_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allergy_list`
--

INSERT INTO `allergy_list` (`id_allergies`, `allergy_name`) VALUES
(1, 'Peanuts'),
(2, 'Seafood'),
(3, 'Egg'),
(4, 'Soybeans'),
(5, 'Dairy'),
(6, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `customer_allergy`
--

CREATE TABLE `customer_allergy` (
  `id` int(11) NOT NULL,
  `username_c` varchar(50) NOT NULL,
  `id_allergies` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_allergy`
--

INSERT INTO `customer_allergy` (`id`, `username_c`, `id_allergies`) VALUES
(1, 'alexconsani', 'peanuts'),
(2, 'alexconsani', 'egg'),
(3, 'alexconsani', 'soybeans'),
(7, 'alexconsani', 'peanuts'),
(10, 'just', 'none'),
(11, 'waza', '6'),
(16, 'james', '6'),
(18, 'qama', '6');

-- --------------------------------------------------------

--
-- Table structure for table `customer_data`
--

CREATE TABLE `customer_data` (
  `username_c` varchar(50) NOT NULL,
  `firstname_c` varchar(50) DEFAULT NULL,
  `lastname_c` varchar(50) DEFAULT NULL,
  `email_c` varchar(100) DEFAULT NULL,
  `phonenum_c` varchar(20) DEFAULT NULL,
  `password_c` varchar(255) NOT NULL,
  `address_c` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_data`
--

INSERT INTO `customer_data` (`username_c`, `firstname_c`, `lastname_c`, `email_c`, `phonenum_c`, `password_c`, `address_c`) VALUES
('alexconsani', 'alex', 'leclerc', 'alexconsani@gmail.com', '0198765432', 'abc', 'paris'),
('haileybieber', 'hailey', 'bieber', 'haileybieber@gmail.com', '0123456789', '123456', 'new york'),
('james', 'james', 'cortis', 'jamess@yahoo.com', '0137654890', '123', ''),
('just', 'justin', 'bieber', 'justiniey@yahoo.com', '01234567890', '456', 'fgfd'),
('mia', '', '', '', '', 'sara', ''),
('nalies', 'natalie', 'elis', 'nalies@yahoo.com', '01234567899', '123', ''),
('qama', 'qama', 'zaini', '2024427304@student.uitm.edu.my', '01128875430', '789', 'pantai dalam'),
('shower', 'shasha', 'mwah', 'shashadive@gmail.com', '0115634223', '123', ''),
('waza', 'wawa', 'zainal', 'wawazainalter@gmail.com', '01975654390', '123', 'Kg. Melayu Sempalit');

-- --------------------------------------------------------

--
-- Table structure for table `customer_prefer`
--

CREATE TABLE `customer_prefer` (
  `id` int(11) NOT NULL,
  `username_c` varchar(50) NOT NULL,
  `id_preference` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_prefer`
--

INSERT INTO `customer_prefer` (`id`, `username_c`, `id_preference`) VALUES
(5, 'alexconsani', 4),
(9, 'just', 4),
(10, 'waza', 3),
(15, 'james', 4),
(18, 'qama', 4);

-- --------------------------------------------------------

--
-- Table structure for table `diet_preference`
--

CREATE TABLE `diet_preference` (
  `id_preference` int(11) NOT NULL,
  `preference_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet_preference`
--

INSERT INTO `diet_preference` (`id_preference`, `preference_name`) VALUES
(1, 'Vegetarian'),
(2, 'Mediterranean'),
(3, 'Pescatarian'),
(4, 'Balanced Diet');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id_menu` int(11) NOT NULL,
  `meal_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `allergy` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id_menu`, `meal_name`, `description`, `price`, `category`, `allergy`, `image`, `status`) VALUES
(5, 'Vegetable Stir-Fry with Brown Rice', 'Ingredients:\r\nBrown rice (150g),\r\nBroccoli (50g),\r\nCarrot (40g),\r\nBell Pepper (40g),\r\nSoy Sauce (10ml),\r\nGarlic', 13.00, 'Vegetarian', 'soybeans', '1001.png', 'Available'),
(6, 'Mushroom and Spinach Pasta', 'Ingredients (1 Pax):\r\nPasta (120g)\r\nmushroom (60g)\r\nspinach (50g)\r\ncream (30ml)\r\nparmesan cheese (15g)', 14.90, 'Vegetarian', 'dairy', '1002.png', 'Unavailable'),
(7, 'Tofu Teriyaki Bowl', 'Ingredients (1 Pax):\r\nTofu (120g)\r\nrice (150g)\r\nbroccoli (40g)\r\ncarrot (40g)\r\nteriyaki sauce', 13.90, 'Vegetarian', 'soybeans', '1003.png', 'Available'),
(8, 'Chickpea Curry with Rice', 'Ingredients (1 Pax):\r\nChickpeas (120g)\r\ncurry sauce (80g)\r\nrice (150g)\r\nonion\r\ntomato', 12.90, 'Vegetarian', 'none', '1004.png', 'Available'),
(9, 'Quinoa Salad with Avocado', 'Ingredients (1 Pax):\r\nQuinoa (100g)\r\navocado (50g)\r\ncucumber (40g)\r\ntomato (40g)\r\nolive oil', 15.90, 'Vegetarian', 'none', '1005.png', 'Available'),
(10, 'Pumpkin Soup with Garlic Bread', 'Ingredients (1 Pax):\r\nPumpkin (200g)\r\nmilk (50ml)\r\ngarlic bread (2 slices)\r\nbutter', 11.90, 'Vegetarian', 'dairy', '1007.png', 'Available'),
(11, 'Veggie Pizza', 'Pizza dough\r\nmozzarella cheese (50g)\r\nmushroom\r\nbell pepper\r\nonion', 16.90, 'Vegetarian', 'dairy', '1008.png', 'Available'),
(12, 'Cauliflower Fried Rice', 'Cauliflower rice (180g)\r\negg (1)\r\ncarrot (40g)\r\npeas (30g)', 12.90, 'Vegetarian', 'egg', '1009.png', 'Available'),
(13, 'Lentil Soup with Whole Grain Bread', 'Ingredients (1 Pax):\r\n\r\nLentils (120g)\r\ncarrot\r\ncelery\r\nwhole grain bread (2 slices)', 11.90, 'Vegetarian', 'none', '1006.png', 'Available'),
(14, 'Tofu and Vegetable Skewers', 'Ingredients (1 Pax):\r\n\r\nTofu (120g)\r\nzucchini (40g)\r\nbell pepper (40g)\r\nonion (30g)', 13.91, 'Vegetarian', 'soybeans', '1010.png', 'Available'),
(15, 'Grilled Chicken with Couscous', 'Ingredients (1 Pax):\r\n\r\nChicken breast (150g)\r\ncouscous (120g)\r\nherbs\r\nolive oil', 17.90, 'Mediterranean', 'none', '2010.png', 'Available'),
(16, 'Mediterranean Quinoa Salad', 'Ingredients (1 Pax):\r\n\r\nQuinoa (100g) \r\ncucumber\r\ntomato\r\nolives\r\nfeta cheese', 15.90, 'Mediterranean', 'dairy', '2009.png', 'Available'),
(17, 'Baked Salmon with Vegetables', 'Salmon fillet (150g) \r\nbroccoli\r\ncarrot\r\nolive oil', 22.90, 'Mediterranean', 'seafood', '2008.png', 'Available'),
(18, 'Grilled Shrimp with Brown Rice', 'Ingredients (1 Pax):\r\n\r\nShrimp (150g)\r\nbrown rice (150g) \r\nvegetables', 20.90, 'Mediterranean', 'seafood', '2007.png', 'Available'),
(19, 'Chicken and Vegetable Skewers', 'Ingredients (1 Pax):\r\n\r\nChicken breast (150g) \r\nzucchini\r\nonion\r\nbell pepper', 17.90, 'Mediterranean', 'none', '2006.png', 'Available'),
(20, 'Olive and Tomato Chicken', 'Ingredients (1 Pax):\r\n\r\nChicken breast (150g)\r\nolives (30g)\r\ntomatoes (60g)', 18.90, 'Mediterranean', 'none', '2003.png', 'Available'),
(21, 'Stuffed Bell Peppers', 'Ingredients (1 Pax):\r\n\r\nBell pepper (3)\r\nquinoa (220g)\r\ncheese (90g)\r\nvegetables', 15.90, 'Mediterranean', 'dairy', '2004.png', 'Available'),
(22, 'Hummus and Falafel Wrap', 'Ingredients (1 Pax):\r\n\r\nFalafel (4 pcs) \r\nhummus (50g)\r\ntortilla wrap\r\nlettuce', 14.90, 'Mediterranean', 'none', '2002.png', 'Available'),
(23, 'Chickpea Mediterranean Bowl', 'Ingredients (1 Pax):\r\n\r\nChickpeas (120g)\r\nquinoa (100g)\r\ncucumber\r\ntomato', 14.90, 'Mediterranean', 'none', '2001.png', 'Available'),
(24, 'Herb-Roasted Chicken Breast', 'Ingredients (1 Pax):\r\n\r\nChicken breast (170g)\r\nrosemary\r\nthyme\r\nvegetables', 18.90, 'Mediterranean', 'none', '2005.png', 'Available'),
(25, 'Grilled Salmon with Brown Rice', 'Ingredients (1 Pax):\r\n\r\nSalmon fillet (150g)\r\nbrown rice (150g)\r\nvegetables', 22.90, 'Pescatarian', 'seafood', '3010.png', 'Available'),
(26, 'Tuna Poke Bowl', 'Ingredients (1 Pax):\r\n\r\nTuna (120g)\r\nrice (150g)\r\ncucumber\r\navocado', 19.90, 'Pescatarian', 'seafood', '3009.png', 'Available'),
(27, 'Shrimp Stir-Fry', 'Ingredients (1 Pax):\r\n\r\nShrimp (150g)]\r\nvegetables\r\nsoy sauce', 18.90, 'Pescatarian', 'seafood,soybeans', '3008.png', 'Available'),
(28, 'Fish Tacos', 'Ingredients (1 Pax):\r\n\r\nFish fillet (120g)\r\ntortilla\r\ncabbage\r\nyogurt sauce', 17.90, 'Pescatarian', 'seafood,dairy', '3007.png', 'Available'),
(29, 'Baked Cod with Vegetables', 'Ingredients (1 Pax):\r\n\r\nCod fillet (150g)\r\nbroccoli\r\ncarrot', 20.90, 'Pescatarian', 'seafood', '3006.png', 'Available'),
(30, 'Teriyaki Salmon Bowl', 'Ingredients (1 Pax):\r\n\r\nSalmon (150g)\r\nrice (150g)\r\nteriyaki sauce', 22.90, 'Pescatarian', 'seafood,soybeans', '3005.png', 'Available'),
(31, 'Garlic Butter Shrimp Pasta', 'Ingredients (1 Pax):\r\n\r\nShrimp (150g)\r\npasta (120g)\r\nbutter\r\ngarlic', 19.90, 'Pescatarian', 'seafood,dairy', '3004.png', 'Available'),
(32, 'Tuna Sandwich with Salad', 'Ingredients (1 Pax):\r\n\r\nTuna (100g)]\r\nbread\r\nmayonnaise\r\nlettuce', 15.90, 'Pescatarian', 'egg,seafood', '3003.png', 'Available'),
(33, 'Fish and Quinoa Bowl', 'Ingredients (1 Pax):\r\n\r\nFish fillet (120g)\r\nquinoa (100g)\r\nvegetables', 18.90, 'Pescatarian', 'seafood', '3002.png', 'Available'),
(34, 'Fish and Quinoa Bowl', 'Ingredients (1 Pax):\r\n\r\nFish fillet (120g)\r\nquinoa (100g)\r\nvegetables', 18.90, 'Pescatarian', 'seafood', '3002.png', 'Available'),
(35, 'Crab Fried Rice', 'Ingredients (1 Pax):\r\n\r\nCrab meat (120g)\r\nrice (150g)\r\negg (1)', 19.90, 'Pescatarian', 'egg,seafood', '3001.png', 'Available'),
(36, 'Grilled Chicken with Brown Rice and Vegetables', 'Ingredients (1 Pax):\r\n\r\nChicken breast (150g)\r\nbrown rice (150g)\r\nvegetables', 17.90, 'Balanced Diet', 'none', '4009.png', 'Available'),
(37, 'Beef Stir-Fry with Mixed Vegetables', 'Ingredients (1 Pax):\r\n\r\nBeef strips (150g)\r\nvegetables\r\nsoy sauce', 18.90, 'Balanced Diet', 'soybeans', '4008.png', 'Available'),
(38, 'Chicken Wrap with Salad', 'Ingredients (1 Pax):\r\n\r\nChicken breast (120g)\r\ntortilla wrap\r\ncheese\r\nlettuce', 15.90, 'Balanced Diet', 'dairy', '4007.png', 'Available'),
(39, 'Turkey Rice Bowl', 'Ingredients (1 Pax):\r\n\r\nTurkey slices (150g)\r\nRice (150g)\r\nvegetables', 18.90, 'Balanced Diet', 'none', '4006.png', 'Available'),
(40, 'Baked Fish with Sweet Potato', 'Ingredients (1 Pax):\r\n\r\nFish fillet (150g)\r\nsweet potato (120g)\r\nvegetables', 19.90, 'Balanced Diet', 'seafood', '4005.png', 'Available'),
(41, 'Chicken Pasta Primavera', 'Ingredients (1 Pax):\r\n\r\nChicken breast (120g)\r\npasta (120g)\r\ncream sauce', 17.90, 'Balanced Diet', 'dairy', '4004.png', 'Available'),
(42, 'Lean Beef and Quinoa Bowl', 'Ingredients (1 Pax):\r\n\r\nLean beef (150g)\r\nquinoa (100g)\r\nvegetables', 19.90, 'Balanced Diet', 'none', '4003.png', 'Available'),
(43, 'Chicken Caesar Salad', 'Ingredients (1 Pax):\r\n\r\nChicken breast (120g)\r\nlettuce\r\nparmesan\r\nCaesar dressing', 16.90, 'Balanced Diet', 'egg,dairy', '4002.png', 'Available'),
(44, 'Teriyaki Chicken Bowl', 'Ingredients (1 Pax):\r\n\r\nChicken breast (150g)\r\nrice (150g)\r\nteriyaki sauce', 17.90, 'Balanced Diet', 'soybeans', '4001.png', 'Available'),
(45, 'Lean Beef Wrap', 'Ingredients (1 Pax):\r\n\r\nLean beef (120g)\r\ntortilla wrap\r\ncheese\r\nvegetables', 17.90, 'Balanced Diet', 'dairy', '4010.png', 'Available'),
(46, 'Grilled Chicken Avocado Bowl', 'Ingredients (1 Pax): \r\nGrilled chicken breast (150g), Brown rice(150g), Avocado (80g), Bell peppers (60g), Zucchini (40g), Lemon wedges (2 slices), Olive oil (10ml), Mixed herbs (5g)', 18.90, 'Balanced Diet', 'none', '4011.png', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `username_c` varchar(50) DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `username_c`, `items`, `total`, `order_date`, `payment_method`) VALUES
(6, 'qama', 'Grilled Salmon with Brown Rice x1, Pumpkin Soup with Garlic Bread x1, ', 42.88, '2026-06-22 14:27:31', 'Cash'),
(7, 'qama', 'Tofu Teriyaki Bowl x1, Vegetable Stir-Fry with Brown Rice x1, ', 34.40, '2026-06-22 22:21:33', 'Cash'),
(8, 'just', 'Fish and Quinoa Bowl x2, Mushroom and Spinach Pasta x1, ', 61.85, '2026-06-23 14:57:18', 'Card');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `allergy_list`
--
ALTER TABLE `allergy_list`
  ADD PRIMARY KEY (`id_allergies`);

--
-- Indexes for table `customer_allergy`
--
ALTER TABLE `customer_allergy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_c` (`username_c`);

--
-- Indexes for table `customer_data`
--
ALTER TABLE `customer_data`
  ADD PRIMARY KEY (`username_c`);

--
-- Indexes for table `customer_prefer`
--
ALTER TABLE `customer_prefer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_c` (`username_c`),
  ADD KEY `id_preference` (`id_preference`);

--
-- Indexes for table `diet_preference`
--
ALTER TABLE `diet_preference`
  ADD PRIMARY KEY (`id_preference`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_allergy`
--
ALTER TABLE `customer_allergy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer_prefer`
--
ALTER TABLE `customer_prefer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_allergy`
--
ALTER TABLE `customer_allergy`
  ADD CONSTRAINT `customer_allergy_ibfk_1` FOREIGN KEY (`username_c`) REFERENCES `customer_data` (`username_c`);

--
-- Constraints for table `customer_prefer`
--
ALTER TABLE `customer_prefer`
  ADD CONSTRAINT `customer_prefer_ibfk_1` FOREIGN KEY (`username_c`) REFERENCES `customer_data` (`username_c`),
  ADD CONSTRAINT `customer_prefer_ibfk_2` FOREIGN KEY (`id_preference`) REFERENCES `diet_preference` (`id_preference`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
