-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2020 at 02:10 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oswa`
--
CREATE DATABASE IF NOT EXISTS `oswa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `oswa`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `subType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `subType`) VALUES
(2, 'Hand Sanitizer/Gel', NULL),
(3, 'Hand Sanitizer/Liquid', NULL),
(5, 'Mask/KN95', NULL),
(6, 'Mask/Surgical', NULL),
(7, 'Mask/Cloth', NULL),
(8, 'Shoe Cover', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, 'Hand-Sanitizer-1-gallon-jug-picture.jpg', 'image/jpeg'),
(2, 'download.jpeg', 'image/jpeg'),
(5, 'Mask-KN95-ClinicalSupplies.jpg', 'image/jpeg'),
(6, 'Premium KN95 100 pack mask.png', 'image/png'),
(7, 'KN95 Filtration Mask.png', 'image/png'),
(8, 'KN95 Filtration masks 500 pack.png', 'image/png'),
(9, 'Hand Sanitizer Gel.png', 'image/png'),
(10, '55 Gallon Hand Sanitizer.png', 'image/png'),
(11, 'Hand Sanitizer Liquid.png', 'image/png'),
(12, '5 Gallon Liquid hand sanitizer.png', 'image/png'),
(13, '5 Gal Hand Sanitizer.png', 'image/png'),
(14, '5 Gal Liquid Hand sanitizer.png', 'image/png'),
(15, '5 Gallon Hand Sanitizer.png', 'image/png'),
(16, '5 Gal gel Hand sanitizer.png', 'image/png'),
(17, '1 Gallon Hand Sanitizer.png', 'image/png'),
(18, '1 Gallon Gel Hand sanitizer.png', 'image/png'),
(19, 'Disposable Shoe Cover.png', 'image/png'),
(20, 'PE shoe cover.png', 'image/png'),
(21, 'Disposable shoe covers.png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `singleUnit` varchar(100) DEFAULT NULL,
  `itemLink` varchar(500) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `delieveryTime` varchar(100) DEFAULT NULL,
  `freeShipping` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `description` varchar(5000) NOT NULL,
  `purchaseType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `singleUnit`, `itemLink`, `city`, `zipcode`, `phone`, `email`, `delieveryTime`, `freeShipping`, `company`, `website`, `description`, `purchaseType`) VALUES
(5, 'Premium KN95 Masks', '1000', '4099.95', '4099.95', 5, 5, '2020-05-29 21:21:40', '1000', 'https://clinicalsuppliesusa.com/collections/kn95-face-masks/products/kn95-masks-grand-pack-br-1000-units-br-in-stock-buy-now', 'San Diego, CA', '22434', '801-215-9185', '', '', 'NO', 'Clinical Supplies', ' https://clinicalsuppliesusa.com/', 'DISPATCH SAME DAY OR NEXT DAY If the order was placed on the weekend - dispatch will be on Monday  1000 pack of KN95 face masks.  From the manufacturer -   KN95 filter mask features: Breathable and anti-fog for extended use. Three-dimensional filter and lightweight design to comfortably wrap around the ears with built-in elastic bands. The KN95 mask has a 4 layer design:  Surface layer - fine quality non-woven cloth: block air pollution particles from entering. PM2.5 particle layer - ultra-fine cotton filter layer designed to effectively prevent the entrance of PM2.5 particles. Inner protection layer - high-quality meltblown non-woven fabric: soft, breathable and thin. Final fabric protection layer - skin-friendly non-woven fabric layer, complete filtering.', 'Wholesale'),
(8, 'Premium KN95 Masks (100 Pack)', '100', '499.00', '499.00', 5, 6, '2020-05-29 22:58:10', '100', ' https://clinicalsuppliesusa.com/collections/kn95-face-masks/products/kn95-masks-jumbo-pack-br-100-units-br-in-stock-buy-now', 'San Diego, CA', '22434', '801-215-9186', 'clinicalsupplieshq@gmail.com', '', 'NO', 'Clinical Supplies ', ' https://clinicalsuppliesusa.com/', 'Premium KN95 Masks (100 Pack)', 'Wholesale'),
(9, 'KN95 Filtration Masks', '1000', '3300.00', '3300.00', 5, 7, '2020-05-29 23:03:57', '1000', ' https://masksbywhizley.com/collections/kn95-filtration-face-masks/products/kn95-filtration-3-ply-layered-personal-protection-face-mask-1000-pcs-supply', 'Tustin', '92780', ' (714) 675-6200', 'sales@masksbywhizley.com', '', 'NO', 'Masks by Whizley', ' https://masksbywhizley.com/', 'KN95 Filtration Masks', 'Wholesale'),
(10, 'KN95 Filtration Masks (500 Pack)', '500', '1700.00', '1700.00', 5, 8, '2020-05-29 23:09:26', '500', ' https://masksbywhizley.com/collections/kn95-filtration-face-masks/products/kn95-filtration-gb2626-2006-standard-4-ply-personal-protection-face-mask-500pc-supply', 'Tustin', '92780', ' (714) 675-6201', 'sales@masksbywhizley.com', '', 'NO', 'Masks by Whizley', ' https://masksbywhizley.com/', 'KN95 Filtration Masks (500 pack)', 'Wholesale'),
(11, 'Hand Sanitizer Gel', '1', '1650.00', '1650.00', 2, 9, '2020-05-29 23:19:25', '55 Gallons', 'https://solvsource.com/products/hand-sanitizer-gel-1', 'San Diego, CA', '92064', 'N/A', 'kyle@solvsource.com', '', 'NO', 'SolvSource', 'https://solvsource.com/', '55 Gallons of Hand Sanitizer Gel', 'Wholesale'),
(12, '55 Gallons of Hand Sanitizer (Liquid)', '1', '1375.00', '1375.00', 3, 10, '2020-05-29 23:25:33', '55 Gallons', 'https://www.nugentec.com/hand-sanitizer-55-gallon-drum', 'Emeryville', '94608', '888-996-8436', 'salesteam@nugentec.com', '', 'NO', 'NugenTec', 'https://www.nugentec.com/', '55 Gallons of Hand Sanitizer (Liquid)', 'Wholesale'),
(13, 'Hand Sanitizer (8oz Spray Bottle)', '1', '0.00', '0.00', 3, 11, '2020-05-29 23:34:03', '8oz Spray Bottle', 'https://www.nugentec.com/hand-sanitizer-8-oz-bottle', 'Emeryville', '94608', '888-996-8436', 'salesteam@nugentec.com', '', 'NO', 'NugenTec', 'https://www.nugentec.com/', '8oz Spray Bottle', 'Retail'),
(14, 'Hand Sanitizer (5 Gallon)', '1', '160.00', '160.00', 3, 12, '2020-05-29 23:41:18', '5 Gallon', 'https://shop.inkjetinc.com/shop/inks/liquid-hand-sanitizer-5-gallon-pail', 'Willis', '77378', '(800) 280-3245', 'msds@inkjetinc.com', '', 'NO', 'Inkjet Inc', 'https://www.inkjetinc.com/', '5 Gallon Liquid Hand Sanitizer', 'Wholesale'),
(16, 'Hand Sanitizer (5 Gallon Pail)', '1', '110.00', '110.00', 3, 14, '2020-05-29 23:49:42', '5 Gallon', 'https://www.tmcindustries.com/FDA-Approved-Hand-Sanitizer--5-gallon-Pail-80-Liquid-Alcohol_p_823.html', 'Waconia', '55387', '800-772-8179', 'sales@tmcindustries.com', '', 'NO', 'TMC Industries Inc', 'https://www.tmcindustries.com/', '5 Gallon Liquid Hand Sanitizer', 'Wholesale'),
(17, 'Hand Sanitizer (5 Gal)', '1', '159.00', '159.00', 2, 15, '2020-05-29 23:56:21', '5 Gallon', 'https://us.shop.minetanbodyskin.com/products/hand-sanitizer-gel-5-gallon', 'Alexandria', '37012', '1 (800) 914-3880', 'hello@marqgroup.com', '', 'NO', 'B.tan', 'https://us.shop.minetanbodyskin.com/collections/bclean', '5 Gallon Gel Hand Sanitizer', 'Wholesale'),
(18, 'Hand Sanitizer Gel (5 Gallons)', '1', '149.00', '149.00', 2, 16, '2020-05-30 00:07:43', '5 Gallon', 'https://shop.privatelabeltan.com/products/hand-sanitizer-gel-5-gallons?variant=32064668532799', 'NA', 'NA', 'N/A', 'brands@marqgroup.com', '', 'NO', 'Private Label', 'https://privatelabeltan.com/?country=us', '5 Gallon Gel Hand Sanitizer', 'Wholesale'),
(19, 'Hand Sanitizer (1 Gallon)', '1', '0.00', '0.00', 2, 17, '2020-05-30 00:14:11', '1 Gallon', 'https://www.amazon.com/SaniPro-Formulation-Sanitizer-Disinfects-Conditions/dp/B087TJ5XWP/ref=sr_1_4?dchild=1&amp;keywords=gallon+hand+sanitizer&amp;qid=1589992877&amp;sr=8-4', 'Seattle', '98109', '1 (206) 922-0880', 'primary@amazon.com', '', 'NO', 'Amazon', 'amazon.com', '1 Gallon Hand Sanitizer', 'Wholesale'),
(21, 'Hand Sanitizer Gel (1 Gallon)', '1', '6336.00', '6336.00', 2, 18, '2020-05-30 00:23:37', '1 Gallon Hand Sanitizer', 'https://solvsource.com/products/hand-sanitizer-gel-1', 'San Diego, CA', '92064', 'N/A', 'Orders@SolvSource.com', '', 'NO', 'SolvSource', 'https://solvsource.com/', '1 Gallon Hand Sanitizer', 'Wholesale'),
(22, 'Disposable Medical Shoe Covers', '1000', '1970.00', '1970.00', 8, 19, '2020-06-01 23:17:41', '1000 per box', 'https://www.ipromo.com/promo-item/IP-MSHOECVRS/Disposable-Medical-Shoe-Covers-Pair.html?cid=20297&amp;utm_source=google&amp;utm_medium=cpc&amp;utm_term=keyword_+wholesale%20+shoe%20+covers::matchtype_b&amp;utm_content=430531042557::p_::n_g::d_c&amp;gclid=CjwKCAjwztL2BRATEiwAvnALckkspdFC73r7RqfSmn3FX1hqmYhROaVS_47rb4o0QVBoPuobldRcRRoCCjsQAvD_BwE', 'Chicago', '6066', ' +1 888-994-7766', 'sales@ipromo.com', '', 'NO', 'iPromo', 'https://www.ipromo.com/home.jhtm', 'Disposable shoe covers', 'Wholesale');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, ' Admin User', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.jpg', 1, '2020-06-02 00:26:24'),
(2, 'Special User', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2015-09-27 21:59:59'),
(3, 'Default User', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2015-09-27 22:00:15'),
(4, 'Demo User', 'Demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 4, 'no_image.jpg', 1, '2020-06-01 06:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1),
(4, 'ViewOnly', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
